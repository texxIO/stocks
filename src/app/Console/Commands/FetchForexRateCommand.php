<?php

namespace App\Console\Commands;

use App\Jobs\FetchForexRatesJob;
use App\Models\ForexCurrency;
use App\Services\ForexService;
use Illuminate\Console\Command;

class FetchForexRateCommand extends Command
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

        foreach ($currency_pairs as $currency_pair) {

            FetchForexRatesJob::dispatch($currency_pair, $this->forexService);
        }
        $this->info('Successfully dispatched the fetch currency rates jobs.');
    }
}
