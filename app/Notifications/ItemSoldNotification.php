<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ItemSoldNotification extends Notification
{
    use Queueable;

    protected $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $formattedPrice = intval($this->item->price);
        return (new MailMessage)
            ->subject('商品が売れました！')
            ->line('出品した商品が売れましたのでお知らせします。')
            ->line('商品の詳細:')
            ->line('商品名: ' . $this->item->name)
            ->line('価格: ' . $formattedPrice);
    }
}
