<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransferApprovalRequested extends Notification
{
    use Queueable;

    protected $transfer;
    protected $approval;

    /**
     * Create a new notification instance.
     */
    public function __construct($transfer, $approval)
    {
        $this->transfer = $transfer;
        $this->approval = $approval;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Asset Transfer Approval Requested')
            ->greeting('Hello ' . ($notifiable->name ?? ''))
            ->line('You are required to approve an asset transfer (ID: ' . $this->transfer->id . ').')
            ->line('Role: ' . $this->approval->role)
            ->line('Assets: ' . $this->transfer->assets->pluck('name')->join(', '))
            ->action('Review Transfer', url(route('transfers.show', $this->transfer->id)))
            ->line('Please review and approve or reject the transfer.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'transfer_id' => $this->transfer->id,
            'approval_id' => $this->approval->id,
            'role' => $this->approval->role,
            'assets' => $this->transfer->assets->pluck('name'),
            'message' => 'You are required to approve an asset transfer (ID: ' . $this->transfer->id . ') as ' . $this->approval->role . '.',
        ];
    }
}
