<?php

namespace Database\Seeders;

use App\Models\ForexCurrency;

use Illuminate\Database\Seeder;


class ForexCurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currency_pairs = [
            ['from_currency_code' => 'USD', 'from_currency_name' => 'US Dollar', 'to_currency_code' => 'JPY', 'to_currency_name' => 'Japanese Yen'],
            ['from_currency_code' => 'USD', 'from_currency_name' => 'US Dollar', 'to_currency_code' => 'EUR', 'to_currency_name' => 'Euro'],
            ['from_currency_code' => 'USD', 'from_currency_name' => 'US Dollar', 'to_currency_code' => 'GBP', 'to_currency_name' => 'British Pound Sterling'],
            ['from_currency_code' => 'USD', 'from_currency_name' => 'US Dollar', 'to_currency_code' => 'CHF', 'to_currency_name' => 'Swiss Franc'],
            ['from_currency_code' => 'USD', 'from_currency_name' => 'US Dollar', 'to_currency_code' => 'CAD', 'to_currency_name' => 'Canadian Dollar'],
            ['from_currency_code' => 'USD', 'from_currency_name' => 'US Dollar', 'to_currency_code' => 'AUD', 'to_currency_name' => 'Australian Dollar'],
            ['from_currency_code' => 'USD', 'from_currency_name' => 'US Dollar', 'to_currency_code' => 'NZD', 'to_currency_name' => 'New Zealand Dollar'],
            ['from_currency_code' => 'EUR', 'from_currency_name' => 'EUR', 'to_currency_code' => 'USD', 'to_currency_name' => 'USD'],


        ];

        foreach ($currency_pairs as $currency_pair) {
            ForexCurrency::create($currency_pair);
        }
    }
}
