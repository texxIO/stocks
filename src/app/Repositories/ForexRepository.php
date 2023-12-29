<?php

namespace App\Repositories;

use App\Interfaces\ForexRepositoryInterface;
use App\Models\ForexCurrency;
use App\Models\ForexRate;
use Illuminate\Support\Facades\Cache;

class ForexRepository implements ForexRepositoryInterface
{
    public function save(array $data, ForexCurrency $forexCurrency)
    {
        $data['currency_id'] = $forexCurrency->id;

        return ForexRate::create($data);
    }

    public function findBySymbol(string $currency_pair)
    {
        $cacheKey = 'forex_rates_for__'.$currency_pair;

        $response = Cache::remember($cacheKey, now()->addMinutes(5), function () use ($currency_pair) {

            return ForexCurrency::where('currency_pair', $currency_pair)->first()->forexRates()->orderBy('created_at', 'desc')->get();
        });

        return $response;
    }

    public function getCurrency()
    {
        $cacheKey = 'forex_currencies';
        $response = Cache::remember($cacheKey, now()->addMinutes(5), function () {
            return ForexCurrency::all();
        });

        return $response;

    }
}
