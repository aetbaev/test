<?php

namespace App\Services;

use App\Clients\ChatAppClient;
use App\Models\Token;

class ChatAppService
{
    public function __construct(private ChatAppClient $client)
    {
        $token = Token::latest('id')->first();

        if (!$token) {
            $data = $this->client->authorize(
                email: config('chatapp.email'),
                password: config('chatapp.password'),
                appId: config('chatapp.appId')
            );

            Token::create([
                'cabinet_user_id' => $data['cabinetUserId'],
                'access_token' => $data['accessToken'],
                'access_token_end_time' => $data['accessTokenEndTime'],
                'refresh_token' => $data['refreshToken'],
                'refresh_token_end_time' => $data['refreshTokenEndTime'],
            ]);
        }
    }
}
