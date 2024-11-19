<?php

namespace App\Jobs;

use App\Models\BroadcastRecipient;
use App\Services\ChatAppService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendBroadcastMessagesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected BroadcastRecipient $broadcastRecipient,
        protected string             $message
    )
    {
        //
    }

    public function handle(ChatAppService $service): void
    {
        $service->sendMessage($this->broadcastRecipient, $this->message);
    }
}
