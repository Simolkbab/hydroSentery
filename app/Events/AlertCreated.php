<?php
namespace App\Events;

use App\Models\Alert;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AlertCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $alert;

    /**
     * Create a new event instance.
     */
    public function __construct(Alert $alert)
    {
        $this->alert = $alert;
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn()
    {
        return new Channel('alerts');
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->alert->id,
            'message' => $this->alert->message,
            'created_at' => $this->alert->created_at->format('d/m/Y H:i'),
            'is_read'=> $this->alert->is_read,
        ];
    }

    // public function broadcastOn()
    // {
    //     return "alertCreated";

    // }

}