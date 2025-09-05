<?php
return [
    "refresh_token" => env('ZALO_REFRESH_TOKEN'),
    'access_token' => env('ZALO_ACCESS_TOKEN'),
    'oa_id' => env('ZALO_OA_ID'),
    'api_url' => 'https://openapi.zalo.me/v2.0/oa/message',
];
