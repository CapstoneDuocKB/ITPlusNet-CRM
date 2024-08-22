<?php

return [
    'unique' => 'El :attribute ya está en uso.',  // Mensaje general para todos los campos

    'custom' => [
        'email' => [
            'unique' => 'El correo electrónico ya está en uso.',  // Mensaje personalizado solo para el email
        ],
        'rut' => [
            'unique' => 'El rut ya está en uso.',  // Mensaje personalizado solo para el email
        ],
        'password' => [
            'confirmed' => 'Las contraseñas no coinciden.',
        ],
    ],
    'max' => [
        'numeric' => 'El :attribute no debe ser mayor que :max.',
        'file' => 'El :attribute no debe ser mayor a :max kilobytes.',
        'string' => 'El :attribute no debe ser mayor a :max caracteres.', // Este es el mensaje que afecta el campo `rut`
        'array' => 'El :attribute no debe tener más de :max elementos.',
    ],
];