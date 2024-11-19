<?php

namespace App\Services;

use App\Clients\ChatAppClient;
use App\Events\BroadcastCreated;
use App\Models\Broadcast;
use App\Models\BroadcastRecipient;
use App\Models\Token;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

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

            $token = Token::create([
                'cabinet_user_id' => $data['cabinetUserId'],
                'access_token' => $data['accessToken'],
                'access_token_end_time' => $data['accessTokenEndTime'],
                'refresh_token' => $data['refreshToken'],
                'refresh_token_end_time' => $data['refreshTokenEndTime'],
            ]);
        }

        $this->client->setAccessToken($token->access_token);
        $this->client->licenseId(config('chatapp.licenseId'));
    }

    public function createBroadcast(Request $request): Broadcast
    {
        $broadcast = Broadcast::create([
            'message' => $request->get('message'),
        ]);

        $phones = preg_split('/\r\n|\r|\n/', $request->get('phones'));
        $phones = array_filter(array_map('trim', $phones));

        foreach ($phones as $phone) {
            BroadcastRecipient::create([
                'broadcast_id' => $broadcast->id,
                'phone' => $phone,
            ]);
        }

        event(new BroadcastCreated($broadcast));

        return $broadcast;
    }

    public function sendMessage(BroadcastRecipient $broadcastRecipient, string $message): BroadcastRecipient
    {
        try {
            $result = $this->client->sendMessage($broadcastRecipient->phone, $message);

            if (isset($result['id'])) {
                $broadcastRecipient->update([
                    'status' => 'sent',
                    'message_api_id' => $result['id'],
                ]);
            } else {
                throw new Exception('Message_id not received');
            }
        } catch (Exception $e) {
            $broadcastRecipient->update([
                'status' => 'error',
            ]);
        }

        return $broadcastRecipient->refresh();
    }

    /**
     * @throws GuzzleException
     */
    public function refreshAccessToken(string $refreshToken): Token
    {
        $data = $this->client->refreshAccessToken($refreshToken);

        return Token::create([
            'cabinet_user_id' => $data['cabinetUserId'],
            'access_token' => $data['accessToken'],
            'access_token_end_time' => $data['accessTokenEndTime'],
            'refresh_token' => $data['refreshToken'],
            'refresh_token_end_time' => $data['refreshTokenEndTime'],
        ]);
    }
}
