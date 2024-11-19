<?php

namespace App\Providers;

use App\Clients\ChatAppClient;
use App\Services\ChatAppService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class ChatAppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(abstract: ChatAppService::class, concrete: function ($app) {
            $guzzleClient = new Client();
            $client = new ChatAppClient($guzzleClient);

            return new ChatAppService($client);
        });
    }

    public function boot()
    {
        //
    }
}
