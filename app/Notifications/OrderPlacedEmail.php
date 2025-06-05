<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Order;

class OrderPlacedEmail extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Confirmation de votre commande')
            ->greeting('Bonjour ' . $notifiable->name)
            ->line('Merci pour votre commande. Voici les détails :')
            ->line('Commande n° : #' . $this->order->id)
            ->line('Total : ' . number_format($this->order->total, 2) . ' MAD')
            ->line('Adresse : ' . $this->order->address)
            ->line('Mode de paiement : Paiement à la livraison')
            ->line('Nous vous contacterons bientôt pour la livraison.')
            ->salutation('Cordialement, votre boutique.');
    }
}


