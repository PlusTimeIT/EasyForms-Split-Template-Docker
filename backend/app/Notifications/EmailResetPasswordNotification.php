<?php
namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailResetPasswordNotification extends Notification
{
    /**
     * Password Reset Token.
     *
     * @var string $token
     */
    protected $token;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $token)
    {
        $this->token = $token;
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = 'http://localhost:3456/#/login/reset?token=' . urlencode($this->token) . '&email=' . urlencode($notifiable->email);
        return (new MailMessage())
            ->subject('Reset Password Notification')
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', $url)
            ->line('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')])
            ->line('If you did not request a password reset, no further action is required.');
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
}
