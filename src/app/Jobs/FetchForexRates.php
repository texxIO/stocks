<?php

namespace App\Jobs;


use App\Models\ForexCurrency;
use App\Services\ForexService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class FetchForexRates implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private ForexService $forexService;

    /**
     * Create a new job instance.
     */
    public function __construct(ForexService $forexService)
    {
        //
        $this->forexService = $forexService;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $currency_pairs = ForexCurrency::all();
        $status = [];
        foreach ($currency_pairs as $currency_pair) {
            $status[] = $this->forexService->saveForexRate($currency_pair);
        }
    }
}
