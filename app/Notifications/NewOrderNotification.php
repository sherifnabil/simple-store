<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewOrderNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Product $product
    ) {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail(mixed $notifiable): MailMessage
    {
        return (new MailMessage)
        ->line("Congratilations You've made a new Order for product {$this->product->title}")
        ->line('Thank you for using our application!');
    }

    public function toArray(mixed $notifiable): array
    {
        return [
            //
        ];
    }
}
