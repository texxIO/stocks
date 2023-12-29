<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForexCurrency extends Model
{
    use HasFactory;

    protected $table = 'forex_currencies';

    protected $fillable = [
        'from_currency_code',
        'from_currency_name',
        'to_currency_code',
        'to_currency_name',
        'currency_pair',

    ];

    public function forexRates()
    {
        return $this->hasMany(ForexRate::class, 'currency_id');
    }
}
