<?php

namespace App\Services;

use App\DTO\ForexApiResponseDTO;
use App\Models\ForexCurrency;
use App\Repositories\ForexRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ForexService
{
    const API_URL = 'https://www.alphavantage.co/query';
    const CACHE_TTL = 60;
    const CACHE_PREFIX = 'forex_quote_';
    const API_FUNCTION = 'CURRENCY_EXCHANGE_RATE';
    private ForexRepository $forexRateRepository;

    public function __construct(ForexRepository $forexRateRepository)
    {
        $this->forexRateRepository = $forexRateRepository;

    }

    public function saveForexRate(ForexCurrency $forexCurrency)
    {


        $api_key = config('services.alpha_vantage.api_key');

        $cached_quote = Cache::get(self::CACHE_PREFIX . $forexCurrency);

        if ($cached_quote) {
            return $cached_quote;
        }

        try {
            $response = Http::get(self::API_URL . "?function=" . self::API_FUNCTION . "&from_currency={$forexCurrency->from_currency}&to_currency={$forexCurrency->to_currency}&apikey={$api_key}");
            $data = json_decode($response->Body(), true);


            if (!empty($data['Error Message'])) {
                return [];
            }

            Cache::add(self::CACHE_PREFIX . $forexCurrency, $data['Realtime Currency Exchange Rate'], self::CACHE_TTL);
            $rateObject = new ForexApiResponseDTO($data['Realtime Currency Exchange Rate']);
            $this->forexRateRepository->save($rateObject->toArray(), $forexCurrency);
            return json_decode($response->getBody(), true);

        } catch (\Exception $e) {

            return null;
        }
    }
}
