<?php

namespace App\Services;

use GuzzleHttp\Client;

class ZaloService
{
    protected $accessToken;
    protected $client;

    public function __construct()
    {
        $this->accessToken = env('ZALO_OA_ACCESS_TOKEN'); // Đặt token trong file .env
        $this->client = new Client([
            'base_uri' => 'https://openapi.zalo.me/',
        ]);
    }

    /**
     * Gửi tin nhắn Zalo đến số điện thoại.
     *
     * @param string $phone Số điện thoại người nhận.
     * @param string $message Nội dung tin nhắn.
     * @return array
     */
    public function sendMessageToPhone($phone, $message)
    {
        try {
            $response = $this->client->post('v2.0/oa/message', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                    'Content-Type'  => 'application/json',
                ],
                'json' => [
                    'recipient' => [
                        'phone' => $phone,
                    ],
                    'message' => [
                        'text' => $message,
                    ],
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            return $data;
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }
}
