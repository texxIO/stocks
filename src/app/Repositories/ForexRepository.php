<?php

namespace App\Repositories;

use App\Interfaces\ForexRepositoryInterface;
use App\Models\ForexCurrency;
use App\Models\ForexRate;


class ForexRepository implements ForexRepositoryInterface
{
    public function save(array $data, ForexCurrency $forexCurrency)
    {
        $data['currency_id'] = $forexCurrency->id;
        return ForexRate::create($data);
    }

    public function findBySymbol(string $currency_pair)
    {
        $response = ForexCurrency::where('currency_pair', $currency_pair)->first()->forexRates()->orderBy('created_at', 'desc')->get();

        return $response;
    }

    public function getCurrency()
    {
        return ForexCurrency::all();
    }

}
