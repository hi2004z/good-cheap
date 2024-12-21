<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyService
{
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->apiUrl = config('services.exchange_rate.api_url', env('EXCHANGE_RATE_API_URL'));
        $this->apiKey = env('EXCHANGE_RATE_API_KEY');
    }

    public function getExchangeRate($baseCurrency = 'USD', $targetCurrency = 'VND')
    {
        try {
            $response = Http::get("{$this->apiUrl}/{$baseCurrency}", [
                'access_key' => $this->apiKey,
            ]);

            if ($response->successful()) {
                $rates = $response->json()['rates'];
                return $rates[$targetCurrency] ?? null;
            }

            throw new \Exception('Failed to fetch exchange rates');
        } catch (\Exception $e) {
            report($e);
            return null;
        }
    }
}
