<?php

namespace Database\Factories;

use App\Models\ForexRate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ForexRate>
 */
class ForexRatesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'from_currency_code' => $this->faker->currencyCode(),
            'from_currency_name' => $this->faker->currencyName(),
            'to_currency_code' => $this->faker->currencyCode(),
            'to_currency_name' => $this->faker->currencyName(),
            'exchange_rate' => $this->faker->randomFloat(2, 0, 100),
            'last_refreshed' => $this->faker->dateTime(),
            'time_zone' => $this->faker->timezone(),
            'bid_price' => $this->faker->randomFloat(2, 0, 100),
            'ask_price' => $this->faker->randomFloat(2, 0, 100),
            'currency_pair' => $this->faker->currencyCode() . '/' . $this->faker->currencyCode(),
        ];
    }
}
