<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class UserNotification extends Notification
{
    use Queueable;

    public $details;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'email' => $this->details['email'],
            'name' => $this->details['name']
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            'email' => $this->details['email'],
            'name' => $this->details['name']
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'email' => $this->details['email'],
            'name' => $this->details['name']
        ]);
    }
}
