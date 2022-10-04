<?php

namespace App\Events;


use App\Models\Notificaciones;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExampleEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notificacion;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Notificaciones $notificacion)
    {
        // $notificaciones = ModelsNotificaciones::with('publicaciones_has_likes','publicaciones_has_likes.likes','publicaciones_has_likes.publicaciones')->get()

        $this->notificacion = $notificacion;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('orders.'.$this->order->id);

        return new Channel('example.'.$this->notificacion->id);
        // return new Channel('example');
    }
}
