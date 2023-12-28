<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('forex_rates', function (Blueprint $table) {
            $table->id();
            $table->integer('currency_id')->foreign('currency_id')->references('id')->on('forex_currencies');
            $table->decimal('exchange_rate', 10, 8);
            $table->dateTime('last_refreshed');
            $table->string('time_zone');
            $table->decimal('bid_price', 10, 8);
            $table->decimal('ask_price', 10, 8);
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forex_rates');
    }
};
