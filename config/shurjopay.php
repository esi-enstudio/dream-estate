<?php

return [
    'api_url' => env('SHURJOPAY_API_URL', 'https://sandbox.shurjopayment.com/api/'),
    'username' => env('SHURJOPAY_MERCHANT_USERNAME'),
    'password' => env('SHURJOPAY_MERCHANT_PASSWORD'),
    'prefix' => env('SHURJOPAY_MERCHANT_PREFIX'),
];
