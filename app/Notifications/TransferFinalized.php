<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransferFinalized extends Notification
{
    use Queueable;

    protected $transfer;
    protected $finalStatus;

    /**
     * Create a new notification instance.
     */
    public function __construct($transfer, $finalStatus)
    {
        $this->transfer = $transfer;
        $this->finalStatus = $finalStatus;
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
        $statusText = $this->finalStatus === 'approved' ? 'approved' : 'rejected';
        return (new MailMessage)
            ->subject('Asset Transfer ' . ucfirst($statusText))
            ->greeting('Hello ' . ($notifiable->name ?? ''))
            ->line('Your asset transfer (ID: ' . $this->transfer->id . ') has been ' . $statusText . '.')
            ->line('Assets: ' . $this->transfer->assets->pluck('name')->join(', '))
            ->action('View Transfer', url(route('transfers.show', $this->transfer->id)))
            ->line('Thank you for using the Asset Management System.');
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
