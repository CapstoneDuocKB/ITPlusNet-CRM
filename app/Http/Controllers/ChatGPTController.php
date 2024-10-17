<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ChatGPTController extends Controller
{
    public function askChatGPT(Request $request)
    {
        // Validar que el mensaje no esté vacío
        $message = $request->input('message');
        if (!$message) {
            return back()->with('error', 'Por favor, ingresa un mensaje.');
        }

        try {
            // Crear el cliente HTTP
            $client = new Client();
            $apiKey = env('OPENAI_API_KEY');

            // Verificar que la API Key esté configurada
            if (!$apiKey) {
                throw new \Exception('API Key de OpenAI no está configurada.');
            }

            // Enviar la solicitud a la API de OpenAI
            $response = $client->post('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type'  => 'application/json',
                ],
                'json' => [
                    'model' => 'gpt-3.5-turbo', // Cambia a 'gpt-4' si tienes acceso
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'You are an assistant.',
                        ],
                        [
                            'role' => 'user',
                            'content' => $message,
                        ]
                    ]
                ],
            ]);

            // Obtener y procesar la respuesta
            $responseData = json_decode($response->getBody(), true);

            // Si la respuesta de OpenAI no es válida o no contiene datos esperados
            if (!isset($responseData['choices'][0]['message']['content'])) {
                throw new \Exception('Respuesta inesperada de OpenAI.');
            }

            $chatResponse = $responseData['choices'][0]['message']['content'];

            // Enviar la respuesta de vuelta a la vista
            return back()->with('response', $chatResponse);

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Manejo de errores relacionados con la solicitud HTTP
            return back()->with('error', 'Error en la solicitud HTTP: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Manejo de cualquier otro tipo de error
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
