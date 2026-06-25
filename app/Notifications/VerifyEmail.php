<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class VerifyEmail extends Notification
{
    use Queueable;



    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        //Generar URL de verificación temporalmente firmada
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );

        return (new MailMessage)
            ->subject('Confirma tu cuenta en EmpleaPro')
            ->greeting('¡Hola ' . $notifiable->name . '!')
            ->line('Gracias por registrarte en EmpleaPro. Por favor, haz clic en el siguiente enlace para verificar tu dirección de correo electrónico y activar tu cuenta.')
            ->action('Verificar correo', $verificationUrl)
            ->line('Si no te registraste en EmpleaPro, puedes ignorar este correo.')
            ->salutation('¡Gracias por unirte a EmpleaPro');
    }
}