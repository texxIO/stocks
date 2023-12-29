<?php

namespace App\Jobs;

use App\Models\ForexCurrency;
use App\Services\ForexService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class FetchForexRatesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    public int $timeout = 120;

    /**
     * Execute the job.
     */
    public function handle(ForexService $forexService, ForexCurrency $forexCurrency): void
    {
        try {
            $forexService->saveForexRate($forexCurrency);
        } catch (\Exception $e) {
            Log::error('Failed to fetch forex rate: '.$e->getMessage());
            $this->release(10); // Release the job back onto the queue with a delay of 60 seconds
        }
    }
}
