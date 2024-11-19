<?php

namespace App\Console\Commands;

use App\Models\Token;
use App\Services\ChatAppService;
use Illuminate\Console\Command;

class UpdateTokenCommand extends Command
{
    protected $signature = 'token:update';

    protected $description = 'Update ChatApp token';

    public function handle()
    {
        /** @var ChatAppService $service */
        $service = app(ChatAppService::class);

        $token = Token::latest('id')->first();

        if ($token && now()->timestamp >= ($token->access_token_end_time - 3600)) {
            $service->refreshAccessToken($token->refresh_token);
        }
    }
}
