<?php

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;

class SalatTimeNotification extends Notification
{
    public $salatTime;

    public function __construct($salatTime)
    {
        $this->salatTime = $salatTime;
    }

    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->content('Reminder: Salat time is coming up at ' . $this->salatTime);
    }
}

