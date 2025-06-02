<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendEmailToAdminAfterRegistrationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

        public $code;
        public $email;

    public function __construct($codeToSend,$SendToemail)
    {
        $this->code = $codeToSend;
        $this->email = $SendToemail;
    }

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
        return (new MailMessage)
            ->subject('Création de compte Administrateur')
            ->greeting('Bonjour')
            ->line('Votre compte a été créé avec succès sur la plateforme de gestion de salaire et d\'employé.')
            ->line('Pour valider votre compte, veuillez utiliser le code suivant :')
            ->line('Code de validation : ' . $this->code)
            ->action('Valider mon compte', url('/validate-account/' . $this->email))
            ->line('Ce code est valable pendant 24 heures.')
            ->line('Si vous n\'avez pas demandé la création de ce compte, veuillez ignorer cet email.')
            ->salutation('Cordialement');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
