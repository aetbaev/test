<?php

namespace App\Clients;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use Psr\Http\Client\ClientInterface;

class ChatAppClient
{
    private string $accessToken;

    private string $baseUrl = 'https://api.chatapp.online';

    public function __construct(private ClientInterface $client)
    {
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function authorize(string $email, string $password, string $appId): array
    {
        $response = $this->client->post($this->baseUrl . '/v1/tokens',
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'email' => $email,
                    'password' => $password,
                    'appId' => $appId,
                ],
            ]);

        if ($response->getStatusCode() == 200) {
            $body = $response->getBody();
            $data = Arr::get(json_decode((string)$body, true), 'data');

            if (!empty($data)) {
                return $data;
            }
        }

        throw new Exception('Authorization failed');
    }

    public function setAccessToken(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }
}
