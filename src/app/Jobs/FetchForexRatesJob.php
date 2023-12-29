<?php

namespace App\Jobs;


use App\Models\ForexCurrency;
use App\Services\ForexService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class FetchForexRatesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private ForexService $forexService;
    private ForexCurrency $forexCurrency;

    /**
     * Create a new job instance.
     */
    public function __construct(ForexCurrency $forexCurrency, ForexService $forexService)
    {
        //
        $this->forexService = $forexService;
        $this->forexCurrency = $forexCurrency;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $status[] = $this->forexService->saveForexRate($this->forexCurrency);

    }
}
