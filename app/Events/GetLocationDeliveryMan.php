<?php

namespace CodeDelivery\Events;

use CodeDelivery\Events\Event;
use CodeDelivery\Models\Geo;
use CodeDelivery\Models\Order;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class GetLocationDeliveryMan extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $geo;
    private $modelOrder;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Geo $geo, Order $modelOrder)
    {
        $this->geo = $geo;
        $this->modelOrder = $modelOrder;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [$this->modelOrder->hash];
    }
}
