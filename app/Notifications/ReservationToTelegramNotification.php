<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class ReservationToTelegramNotification extends Notification
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

        $message = "*🛎️ Новое бронирование тура #{$o->id}*\n\n";
        $message .= "*Имя:* {$o->name}\n";
        $message .= "*Телефон:* {$o->phone}\n";
        $message .= "*Email:* {$o->email}\n";
        $message .= "*Тур:* {$o->tour->title}\n";
        $message .= "*Даты брони:* {$o->booking->date_from} – {$o->booking->date_to}\n";
        $message .= "*Кол-во взрослых:* {$o->count_adults}\n";
        $message .= "*Кол-во детей:* {$o->count_child}\n";
        $message .= "*Комментарий:* " . ($o->comment ?: '—') . "\n";

        return TelegramMessage::create()
            ->to($notifiable->routeNotificationForTelegram($this))
            ->content($message)
            ->options(['parse_mode' => 'Markdown']);
    }
}
