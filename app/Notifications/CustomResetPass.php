<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPass extends Notification
{
    use Queueable;

    // 1. Khai báo biến token
    private $token;

    /**
     * 2. Điều chỉnh lại constructor để nhận biến $token
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
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
     * 3. Điều chỉnh nội dung email và sử dụng view custom để gửi email
     */
    public function toMail(object $notifiable): MailMessage
    {
        // Tạo link reset với token
        $url = route("password.reset", ["token" => $this->token]);

        return (new MailMessage)
                    ->subject('Lấy lại mật khẩu') // Tiêu đề email
                    ->view('email_template.reset_pass',compact("url")); // Sử dụng view tùy chỉnh
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
