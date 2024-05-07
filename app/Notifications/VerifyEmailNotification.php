<?php

namespace App\Notifications;

use App\Models\EmailVerification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class VerifyEmailNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
    }

    public function tokenGeneration($admin)
    {
        $randomString = Str::random(60);
        EmailVerification::create([
            'admin_id' => $admin->id,
            'token' => $randomString,
        ]);
        return URL::temporarySignedRoute(
            'admin.email.verify',
            now()->addMinutes(1),
            ['token' =>
            $randomString]
        );
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
        $tokennReturn = $this->tokenGeneration($notifiable);
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Verfication url', $tokennReturn)
            ->line('Thank you for using our application!');
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
