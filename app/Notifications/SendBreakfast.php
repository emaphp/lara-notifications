<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;

class SendBreakfast extends Notification implements ShouldQueue
{
    use Queueable;
    protected $delegat;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($delegat)
    {
        $this->delegat = $delegat;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = route('breakfast');
        return (new MailMessage)
                    ->line("El encargado de traer las facturas para el desayuno esta semana es: " .$this->delegat->name)
                    ->action('Go to BreakfastList', $url);
               
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
