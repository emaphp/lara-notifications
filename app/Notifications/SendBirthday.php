<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Channels\WhatsappChannel; //------------
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendBirthday extends Notification
{
    use Queueable;
    protected $birthdays;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($birthdays)
    {
        $this->birthdays = $birthdays;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', WhatsappChannel::class]; 
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $birthdaysList = implode(PHP_EOL, $this->birthdays->pluck('name')->all());
        return (new MailMessage)
                    ->line("Hoy es el Cumpleaños de :" . $birthdaysList);

    }

    public function toWhatsapp($notifiable)
    {
        $birthdaysList = implode(PHP_EOL, $this->birthdays->pluck('name')->all());
        return("Hoy es el cumpleaños de :" . $birthdaysList);
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
