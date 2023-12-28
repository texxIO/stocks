<?php

namespace App\Services;

use App\DTO\ForexApiResponseDTO;
use App\Models\ForexCurrency;
use App\Models\ForexRate;
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
    public function saveForexRate(ForexCurrency $forexCurrency) {


        $api_key = config('services.alpha_vantage.api_key');

        $cached_quote = Cache::get(self::CACHE_PREFIX. $forexCurrency);

        if ($cached_quote) {
            dump('Cache hit');
            dump($cached_quote);
            $rateObject = new ForexApiResponseDTO($cached_quote);


            return $cached_quote;
        }

        try {
            $response = Http::get(self::API_URL."?function=".self::API_FUNCTION."&from_currency={$forexCurrency->from_currency}&to_currency={$forexCurrency->to_currency}&apikey={$api_key}");
            $data = json_decode($response->Body(), true);

            $data = json_decode('{
                            "Realtime Currency Exchange Rate": {
                                "1. From_Currency Code": "EUR",
                                "2. From_Currency Name": "Euro",
                                "3. To_Currency Code": "USD",
                                "4. To_Currency Name": "United States Dollar",
                                "5. Exchange Rate": "1.11163000",
                                "6. Last Refreshed": "2023-12-28 01:09:01",
                                "7. Time Zone": "UTC",
                                "8. Bid Price": "1.11157800",
                                "9. Ask Price": "1.11164800"
                            }
                        }', true);


            if (!empty($data['Error Message'])) {
                return [];
            }

            Cache::add(self::CACHE_PREFIX. $forexCurrency, $data['Realtime Currency Exchange Rate'], self::CACHE_TTL);
            $rateObject = new ForexApiResponseDTO($data['Realtime Currency Exchange Rate']);
            $this->forexRateRepository->save($rateObject->toArray(), $forexCurrency);
//            return json_decode($response->getBody(), true);
            return $data['Realtime Currency Exchange Rate'];
        } catch (\Exception $e) {
            dump($data);
            dump($e->getMessage());
            return null;
        }
    }
}
