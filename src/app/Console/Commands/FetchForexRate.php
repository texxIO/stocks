<?php

namespace App\Console\Commands;

use App\Models\ForexCurrency;
use App\Services\ForexService;
use Illuminate\Console\Command;

class FetchForexRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stocks:fetch-forex-quote';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch forex quotes from Alpha Vantage API';

    private ForexService $forexService;

    public function __construct(ForexService $forexService)
    {
        parent::__construct();
        $this->forexService = $forexService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $currency_pairs = ForexCurrency::all();
        $status = [];
        foreach ($currency_pairs as $currency_pair) {
            $status[] = $this->forexService->saveForexRate($currency_pair);
        }


        if (empty($status)) {
            $this->info("Successfully fetched forex quotes.");
        } else {
            $this->error("Failed to fetch stock quote for.");
        }
    }
}
