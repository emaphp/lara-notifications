<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Twilio\Rest\Client;

class WhatsappChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toWhatsapp($notifiable);

        if ($notifiable->profile && $notifiable->profile->telephone) {
            $sid = config('whatsapp.sid');
            $token = config('whatsapp.token');
            $client = new Client($sid, $token);

            $client->messages->create(
                // Number receiver
                whatsappPhone($notifiable->profile->telephone),
                array(
                    'from' => config('whatsapp.number'),
                    'body' => $message
                )
            );
        }
    }
}