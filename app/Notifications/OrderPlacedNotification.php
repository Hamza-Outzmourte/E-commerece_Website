<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class OrderPlacedNotification extends Notification
{
    use Queueable;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database']; // tu peux aussi mettre 'mail' si tu veux envoyer un email
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Votre commande (#' . $this->order->id . ') a été passée avec succès.',
            'order_id' => $this->order->id,
        ];
    }
}
