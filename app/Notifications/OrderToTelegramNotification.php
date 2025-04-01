<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class OrderToTelegramNotification extends Notification
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['telegram'];
    }

    /**
     * Get the Telegram representation of the notification.
     */
    public function toTelegram($notifiable)
    {
        $order = $this->order;
        $message = "*🔍 Новая заявка на поиск тура #{$order->id}*\n\n";
        $message .= "*Имя:* {$order->name}\n";
        $message .= "*Телефон:* {$order->phone}\n";

        return TelegramMessage::create()
            ->to($notifiable->routeNotificationForTelegram($this))
            ->content($message)
            ->options(['parse_mode' => 'Markdown']);
    }

}
