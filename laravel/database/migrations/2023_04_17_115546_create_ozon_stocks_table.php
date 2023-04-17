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
        Schema::create('ozon_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('offer_id')->nullable();
            $table->bigInteger('product_id')->nullable();
            $table->bigInteger('fbs_present')->nullable();
            $table->bigInteger('fbs_reserved')->nullable();
            $table->bigInteger('fbo_present')->nullable();
            $table->bigInteger('fbo_reserved')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ozon_stocks');
    }
};
