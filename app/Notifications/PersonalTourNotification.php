<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class PersonalTourNotification extends Notification
{
    use Queueable;

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable): array
    {
        return ['telegram'];
    }

    public function toTelegram($notifiable)
    {
        $o = $this->order;

        $message = "*🏢 Новая заявка на корпоративный тур #{$o->id}*\n\n";
        $message .= "*Имя:* {$o->name}\n";
        $message .= "*Телефон:* {$o->phone}\n";
        $message .= "*Email:* {$o->email}\n";
        $message .= "*Комментарий:* " . ($o->comment ?: '—') . "\n";

        return TelegramMessage::create()
            ->to($notifiable->routeNotificationForTelegram($this))
            ->content($message)
            ->options(['parse_mode' => 'Markdown']);
    }
}
