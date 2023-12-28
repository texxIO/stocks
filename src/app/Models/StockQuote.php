<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockQuote extends Model
{
    use HasFactory;
    protected $table ='stock_quotes';

    protected $fillable = [
        'symbol_id',
        'quote'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Stock::class);
    }
}
