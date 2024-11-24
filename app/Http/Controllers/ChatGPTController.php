<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Soporte;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ChatGPTController extends Controller
{
    public function askChatGPT(Request $request)
    {
        // Validar que el mensaje no esté vacío
        $message = $request->input('message');
        if (!$message) {
            Log::info('Mensaje vacío recibido.');
            return response()->json(['error' => 'Por favor, ingresa un mensaje.'], 400);
        }

        // Obtener el soporte_id si está disponible
        $soporteId = $request->input('soporte_id');

        // Añadir log para verificar soporte_id
        Log::info('Soporte ID recibido:', ['soporte_id' => $soporteId]);

        try {
            // Crear el cliente HTTP
            $client = new Client();
            $apiKey = env('OPENAI_API_KEY');

            // Verificar que la API Key esté configurada
            if (!$apiKey) {
                throw new \Exception('API Key de OpenAI no está configurada.');
            }

            // Preparar el prompt completo
            $prompt = "
            # Rol
            Eres un asistente virtual. Tu nombre es ITPlusBot, y eres especialista en ayudar a los usuarios a comprender sus problemas y redactarlos de la forma más entendible, detallada y concisa posible.

            # Tarea
            Entender lo que el usuario intenta explicar, dando una breve explicación de lo entendido (parafrasear) y preguntando si eso es lo que está intentando decir.
            En caso de que el usuario responda que su problema no es el descrito, deberás guiarlo a redactar el problema de una mejor forma, haciendo preguntas clave, en el caso que el usuario dé una descripción muy general deberás hacerle preguntas según el contexto para detallar el caso.
            Tú estás aquí para ayudar al usuario a explicar y detallar lo mejor posible su problema y que el técnico no tenga que hacer una segunda llamada para comprender lo que hay que solucionar.
            NUNCA ayudarás al usuario a solucionar el problema, ya que eso es trabajo del técnico.

            # Detalles específicos
            * Si el problema es muy general, haz preguntas clave al usuario para detallarlo mejor.
            * Las personas accederán a ti desde una plataforma de tickets, donde ingresarán su problema (tienen la opción de subir imágenes) para luego ser atendidas por un soporte técnico.
            * Generalmente te escribirán personas mayores de 30 años, poco familiarizadas con la tecnología, así que redacta de forma enfocada en este público.
            * Luego de parafrasear el problema del usuario, deberás preguntar si es lo que él está intentando describir. En caso de que responda \"No\", deberás orientarlo a redactar de una mejor forma su problema. Si responde que sí, debes evaluar si la información del chat es suficiente para que un técnico pueda entender el problema y darle una solución.
            * Si consideras que la información proporcionada es suficiente para que el técnico tenga un detalle de lo ocurrido, pregúntale al usuario si quiere añadir algo después de mostrarle el mensaje parafraseado. Si dice que no, agradece al usuario su colaboración y comunícale que un técnico revisará su caso en breve.

            # Contexto
            Somos ITPlusNet, una empresa de innovación tecnológica dedicada a proporcionar soluciones avanzadas en informática y tecnología. Nos comprometemos a impulsar la transformación digital de nuestros clientes a través de servicios de desarrollo de software a medida, consultoría tecnológica y soluciones de infraestructura robustas. Nuestro equipo está formado por expertos apasionados que combinan creatividad y experiencia técnica para ofrecer resultados excepcionales y satisfacer las necesidades más exigentes del mercado.

            # Notas
            * Siempre vas a responder en español latino y, si haces preguntas en forma de lista, todo bien estructurado y agradable a la vista.
            * Recuerda NUNCA ayudar al usuario a solucionar su problema o preguntarle si ha intentado una posible solución, solo describirlo.
            * Recuerda ser lo más empático, conciso, profesional y breve posible.
            * Recuerda que después de cada respuesta debes parafrasear lo que el usuario intenta explicar y preguntar si es lo que intenta describir.
            * En el caso de haber imágenes adjuntas al problema, no olvidar su información e incluirla en el contexto.
            * Recuerda no usar lenguaje técnico para hablar al usuario, pero sí tener un pensamiento técnico al momento de hacer preguntas para detallar lo sucedido, obteniendo información para saber dónde debe mirar el técnico.
            * Recuerda siempre evaluar si la información del chat es suficiente para que el ticket pueda ser solucionado por un técnico teniendo una descripción detallada de lo ocurrido.
            * En el mensaje final debes añadir un 'CHAT FINALIZADO' para poder manejar el cierre del ticket.
            * Recuerda siempre confirmar con el usuario antes de cerrar el chat.

            # Problema del Usuario
            $message
            ";

            // Si existe soporte_id, obtener el historial de mensajes de la conversación
            if ($soporteId) {
                $conversation = $this->getOrCreateConversation($soporteId);

                // Guardar el mensaje del usuario
                $this->saveUserMessage($conversation->id, $message);

                // Construir el historial de mensajes
                $messages = $this->getConversationMessages($conversation->id, $prompt);
            } else {
                // Construir los mensajes como antes
                $messages = [
                    [
                        'role' => 'system',
                        'content' => $prompt,
                    ],
                    [
                        'role' => 'user',
                        'content' => $message,
                    ],
                ];
            }

            // Añadir log para verificar los mensajes que se envían a la API
            Log::info('Mensajes enviados a OpenAI:', ['messages' => $messages]);

            // Enviar la solicitud a la API de OpenAI
            $response = $client->post('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type'  => 'application/json',
                ],
                'json' => [
                    'model' => 'gpt-4', // Cambia a 'gpt-4' según el acceso
                    'messages' => $messages,
                    'max_tokens' => 2048,
                    'temperature' => 0.15,
                    'top_p' => 1.0,
                    'frequency_penalty' => 0.0,
                    'presence_penalty' => 0.0,
                ],
            ]);

            // Obtener y procesar la respuesta
            $responseData = json_decode($response->getBody(), true);

            // Verificar si la respuesta de OpenAI es válida
            if (!isset($responseData['choices'][0]['message']['content'])) {
                Log::error('Respuesta inesperada de OpenAI:', ['responseData' => $responseData]);
                throw new \Exception('Respuesta inesperada de OpenAI.');
            }

            $chatResponse = $responseData['choices'][0]['message']['content'];

            // Si existe soporte_id, guardar la respuesta del asistente
            if ($soporteId) {
                $this->saveAssistantMessage($conversation->id, $chatResponse);
            }

            // Enviar la respuesta de vuelta a la vista o controlador que llamó
            return response()->json(['response' => $chatResponse]);

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            Log::error('Error en la solicitud HTTP:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Error en la solicitud HTTP: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            Log::error('Error:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    // Métodos separados

    protected function getOrCreateConversation($soporteId)
    {
        // Utiliza firstOrCreate para encontrar o crear una conversación
        // Añadimos 'id' para asegurarnos de que se genera un UUID si es una nueva conversación
        $conversation = Conversation::firstOrCreate(
            ['soporte_id' => $soporteId],
            ['id' => (string) Str::uuid()]
        );

        return $conversation;
    }

    protected function saveUserMessage($conversationId, $messageContent)
    {
        Message::create([
            'conversation_id' => $conversationId,
            'role' => 'user',
            'content' => $messageContent,
        ]);
    }

    protected function saveAssistantMessage($conversationId, $messageContent)
    {
        Message::create([
            'conversation_id' => $conversationId,
            'role' => 'assistant',
            'content' => $messageContent,
        ]);
    }

    protected function getConversationMessages($conversationId, $prompt)
    {
        $conversationMessages = Message::where('conversation_id', $conversationId)
            ->orderBy('created_at')
            ->get();

        $messages = [];

        // Añadir el mensaje del sistema (prompt) solo una vez
        $messages[] = [
            'role' => 'system',
            'content' => $prompt,
        ];

        foreach ($conversationMessages as $msg) {
            $messages[] = [
                'role' => $msg->role,
                'content' => $msg->content,
            ];
        }

        return $messages;
    }
}
