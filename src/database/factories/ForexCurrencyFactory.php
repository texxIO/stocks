<?php

namespace Database\Factories;

use App\Models\ForexCurrency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<ForexCurrency>
 */
class ForexCurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $currencyFrom = $this->faker->currencyCode();
        $currencyTo = $this->faker->currencyCode();
        return [
            'from_currency_code' => $currencyFrom,
            'from_currency_name' => $this->faker->currencyName(),
            'to_currency_code' => $currencyTo,
            'to_currency_name' => $this->faker->currencyName(),
            'currency_pair' => $currencyFrom . '/' . $currencyTo,
        ];
    }
}
