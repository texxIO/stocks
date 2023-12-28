<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stocks';

    protected $fillable = [
        'symbol'
    ];

    public function stockQuotes(): HasMany
    {
        return $this->hasMany(StockQuote::class, 'symbol_id');
    }
}
