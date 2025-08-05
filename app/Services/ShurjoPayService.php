<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ShurjoPayService
{
    protected mixed $apiUrl;
    protected mixed $merchantUsername;
    protected mixed $merchantPassword;
    protected mixed $merchantPrefix;

    public function __construct()
    {
        $this->apiUrl = config('app.shurjopay.api_url', env('SHURJOPAY_API_URL'));
        $this->merchantUsername = config('app.shurjopay.username', env('SHURJOPAY_MERCHANT_USERNAME'));
        $this->merchantPassword = config('app.shurjopay.password', env('SHURJOPAY_MERCHANT_PASSWORD'));
        $this->merchantPrefix = config('app.shurjopay.prefix', env('SHURJOPAY_MERCHANT_PREFIX'));
    }

    /**
     * Get authentication token from ShurjoPay.
     */
    protected function getToken(): ?string
    {
        $response = Http::post($this->apiUrl . 'get_token', [
            'username' => $this->merchantUsername,
            'password' => $this->merchantPassword,
        ]);

        if ($response->successful()) {
            return $response->json('token');
        }

        return null;
    }

    /**
     * Initiate a payment request.
     */
    public function initiatePayment(array $data): array
    {
        $token = $this->getToken();
        if (!$token) {
            // Handle error: could not get token
            return ['error' => 'Authentication failed with payment gateway.'];
        }

        $orderId = $this->merchantPrefix . Str::random(10);

        $payload = [
            'token' => $token,
            'store_id' => $this->merchantUsername, // In v2, store_id is username
            'prefix' => $this->merchantPrefix,
            'currency' => 'BDT',
            'return_url' => route('payment.callback'),
            'cancel_url' => route('payment.cancel'),
            'amount' => $data['amount'],
            'order_id' => $orderId,
            'discsount_amount' => 0,
            'customer_name' => $data['customer_name'],
            'customer_email' => $data['customer_email'],
            'customer_phone' => $data['customer_phone'],
            'customer_address' => 'N/A',
            'customer_city' => 'N/A',
            'customer_post_code' => 'N/A',
            'client_ip' => request()->ip(),
            // Custom fields to pass our internal data
            'value1' => $data['plan_id'], // Pass plan_id
            'value2' => $data['user_id'], // Pass user_id
        ];

        $response = Http::post($this->apiUrl . 'secret-pay', $payload);

        if ($response->successful() && isset($response->json()['checkout_url'])) {
            // Save the transaction details before redirecting
            // We will create a 'transactions' table for this
            return ['redirect_url' => $response->json()['checkout_url'], 'order_id' => $orderId];
        }

        return ['error' => 'Failed to initiate payment. Please try again.'];
    }

    /**
     * Verify a payment after user returns from ShurjoPay.
     */
    public function verifyPayment(string $orderId)
    {
        $token = $this->getToken();
        if (!$token) {
            return ['error' => 'Authentication failed.'];
        }

        $response = Http::post($this->apiUrl . 'verification', [
            'token' => $token,
            'order_id' => $orderId,
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return ['error' => 'Payment verification failed.'];
    }
}
