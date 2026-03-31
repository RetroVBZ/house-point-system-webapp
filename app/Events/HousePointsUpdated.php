<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use App\Models\houses;

class HousePointsUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;

    public $house;

    public function __construct(houses $house)
    {
        $this->house = $house;
    }

    public function broadcastOn()
    {
        return new Channel('leaderboard');
    }
}
