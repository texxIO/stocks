<?php

namespace App\DTO;

class ForexApiResponseDTO
{
    public string $fromCurrencyCode;
    public string $fromCurrencyName;
    public string $toCurrencyCode;
    public string $toCurrencyName;
    public float $exchangeRate;
    public string $lastRefreshed;
    public string $timeZone;
    public float $bidPrice;
    public float $askPrice;

    public function __construct(array $data)
    {

        $this->fromCurrencyCode = $data['1. From_Currency Code'];
        $this->fromCurrencyName = $data['2. From_Currency Name'];
        $this->toCurrencyCode = $data['3. To_Currency Code'];
        $this->toCurrencyName = $data['4. To_Currency Name'];
        $this->exchangeRate = (float)$data['5. Exchange Rate'];
        $this->lastRefreshed = $data['6. Last Refreshed'];
        $this->timeZone = $data['7. Time Zone'];
        $this->bidPrice = (float)$data['8. Bid Price'];
        $this->askPrice = (float)$data['9. Ask Price'];
    }


    public function toArray(): array
    {
        return [
            'from_currency_code' => $this->fromCurrencyCode,
            'from_currency_name' => $this->fromCurrencyName,
            'to_currency_code' => $this->toCurrencyCode,
            'to_currency_name' => $this->toCurrencyName,
            'exchange_rate' => $this->exchangeRate,
            'last_refreshed' => $this->lastRefreshed,
            'time_zone' => $this->timeZone,
            'bid_price' => $this->bidPrice,
            'ask_price' => $this->askPrice,
        ];
    }
}
