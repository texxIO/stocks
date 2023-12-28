<?php

namespace App\Console\Commands;

use App\Models\Stock;
use App\Services\StockService;
use Illuminate\Console\Command;

class FetchStockQuotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stocks:fetch-quotes';

    protected $description = 'Fetch stock quotes from Alpha Vantage API';
    private StockService $stockService;

    public function __construct(StockService $stockService)
    {
        parent::__construct();
        $this->stockService = $stockService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
//        $symbols = ['AAPL', 'MSFT', 'TSLA', 'AMZN', 'FB', 'NFLX'];
//        while ($symbol = array_shift($symbols)) {
//            Stock::create(['symbol'=>$symbol]);
//        }

        $symbols = Stock::all()->toArray();

        while ($symbol = array_shift($symbols)) {

            $this->stockService->getStockQuote($symbol['symbol']);

        }
        $response = Stock::where('symbol', 'NFLX')->first()->stockQuotes()->orderBy('created_at', 'desc')->get();
        foreach ($response->toArray() as $key => $value) {
            dump($value);
        }


//        if ($quote) {
//            $this->info("StockQuote Quote for {$symbols}:\n" . json_encode($quote, JSON_PRETTY_PRINT));
//        } else {
//            $this->error("Failed to fetch stock quote for {$symbol}.");
//        }
    }
}
