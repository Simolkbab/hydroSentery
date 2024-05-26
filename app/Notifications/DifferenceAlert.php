<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DifferenceAlert extends Notification
{
    use Queueable;

    protected $sensorData;

    public function __construct($sensorData)
    {
        $this->sensorData = $sensorData;
    }

    public function via($notifiable)
    {
        return ['mail']; // Adjust according to the notification channels you want to use
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The difference is below the threshold: ' . $this->sensorData->difference)
                    ->action('Notification Action', url('/notification'))
                    ->line('Thank you for using our application!');
    }
}
