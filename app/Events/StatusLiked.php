<?php

namespace App\Events;



use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class StatusLiked implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $username;
    public $message;
    public $publicacion_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($publicacion_id)
    {
        $this->publicacion_id = $publicacion_id;
        $this->username = Auth::user()->name;
        $this->message  = "A {$this->username} liked your status";
    }

    public function broadcastOn()
    {
        return new PrivateChannel('status-liked.'.$this->publicacion_id);

    }
}
