<?php
/*
 * Configuración de Twilio para el envio de mensajes a través de WhatsApp
 * */
return [
    // Used to authenticate REST API requests
    'sid' => env('TWILIO_ACCOUNT_SID'),
    'token' => env('TWILIO_AUTH_TOKEN'),

    // Twilio phone number
    'number' => env('TWILIO_NUMBER')
];