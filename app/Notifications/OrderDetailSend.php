<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderDetailSend extends Notification
{
    use Queueable;

    protected $payload;

    /**
     * Create a new notification instance.
     */
    public function __construct(array $payload)
    {
        $this->payload = $payload;
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
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Đặt hàng thành công")
            ->view("email_template.don_hang_thanh_cong", [
                'items' => $this->payload['items'] ?? [],
                'customerName' => $this->payload['customerName'] ?? '',
                'paymentMethod' => $this->payload['paymentMethod'] ?? '',
            ]);
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
