<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wb_prices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nmId')->nullable();            
            $table->decimal('price')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('promoCode')->nullable();
            $table->date('dateFrom')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wb_prices');
    }
};
