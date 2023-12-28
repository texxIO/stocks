<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ForexRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency_id',
        'exchange_rate',
        'last_refreshed',
        'time_zone',
        'bid_price',
        'ask_price',

    ];

    protected $table = 'forex_rates';

    public function forexCurrency(): BelongsTo
    {
        return $this->belongsTo(ForexCurrency::class);
    }
}
