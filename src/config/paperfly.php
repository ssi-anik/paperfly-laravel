<?php

return [
    'default' => env('USE_PAPERFLY_ACCOUNT', 'default'),

    'accounts' => [
        'default' => [
            'username' => env('PAPERFLY_USERNAME'),
            'password' => env('PAPERFLY_PASSWORD'),
            'required_header_value' => env('PAPERFLY_REQUIRED_HEADER_VALUE'),
            'required_header_key' => env('PAPERFLY_REQUIRED_HEADER_KEY', 'paperflykey'),
            'base_url' => rtrim(env('PAPERFLY_BASE_URL', 'https://api.paperfly.com.bd'), '/'),
        ],
    ],
];
