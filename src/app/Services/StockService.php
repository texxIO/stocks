<?php

namespace App\Services;

use App\Models\Stock;
use App\Models\StockQuote;
use Exception;
use GuzzleHttp\Client;

class StockService
{
    protected Client $client;

    public function __construct()
    {

    }

    public function getStockQuote(string $symbol)
    {

        //        $apiKey = 'your_alpha_vantage_api_key';
        //        $url = "https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol={$symbol}&apikey={$apiKey}";
        //
        $api_key = 'AV8X1W70XHSDQ7SV';

        //        $symbol = $this->argument('symbol');
        //        $apiKey = config('app.ALPHA_VANTAGE_API_KEY');

        //        $client = new Client([ // Use the imported class
        //            'base_uri' => "https://www.alphavantage.co",
        //            'timeout' => 5.0,
        //        ]);
        //stocks: /query?function=GLOBAL_QUOTE&symbol=IBM&apikey={$api_key}
        //https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency=USD&to_currency=JPY&apikey=demo

        //        $response = $client->request('GET', "/query?function=CURRENCY_EXCHANGE_RATE&from_currency=USD&to_currency=JPY&apikey={$api_key}");
        //        $response = $client->request('GET', "/query?function=GLOBAL_QUOTE&symbol={$symbol}&apikey={$api_key}");
        //        $response = Http::get('https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol=IBM&apikey=AV8X1W70XHSDQ7SV')

        try {

            StockQuote::create([
                'symbol_id' => Stock::where('symbol', $symbol)->first()->id,
                'quote' => rand(0, 50),
            ]);

            $response = Stock::where('symbol', $symbol)->first()->stockQuotes()->orderBy('created_at', 'desc')->first();

            return $response;
            //            $response = $this->client->get("/query?function=GLOBAL_QUOTE&symbol={$symbol}&apikey={$api_key}");
            //            $response = Http::get("https://www.alphavantage.co//query?function=GLOBAL_QUOTE&symbol={$symbol}&apikey={$api_key}");

            //            $data = json_decode($response->Body(), true);
            //            if (!empty($data['Error Message'])) {
            //                // Handle error
            //                return;
            //            }
            //            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            // Handle exception
            return null;
        }
    }
}
