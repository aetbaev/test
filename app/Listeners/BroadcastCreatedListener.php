<?php

namespace App\Listeners;

use App\Events\BroadcastCreated;
use App\Jobs\SendBroadcastMessagesJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Queue;

class BroadcastCreatedListener implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(BroadcastCreated $event): void
    {
        $broadcast = $event->broadcast;

        $totalDelay = mt_rand(5, 50);

        foreach ($broadcast->recipients as $recipient) {
            Queue::later($totalDelay, new SendBroadcastMessagesJob($recipient, $broadcast->message));
            $totalDelay += mt_rand(5, 50);
        }
    }
}
