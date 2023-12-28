<?php

namespace App\Interfaces;

use App\Models\ForexCurrency;

interface ForexRepositoryInterface
{
    public function save(array $data, ForexCurrency $forexCurrency);

    public function findBySymbol(string $currency_pair);

}
