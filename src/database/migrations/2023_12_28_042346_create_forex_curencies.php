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
        Schema::create('forex_currencies', function (Blueprint $table) {
            $table->id();
            $table->string('from_currency_code');
            $table->string('from_currency_name');
            $table->string('to_currency_code');
            $table->string('to_currency_name');
            $table->string('currency_pair')->virtualAs('CONCAT(from_currency_code, to_currency_code)');

            $table->timestamps();
            $table->index('currency_pair');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forex_currencies');
    }
};
