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
        Schema::create('ozon_fbo_lists', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->nullable();
            $table->string('order_number')->nullable();
            $table->string('posting_number')->nullable();
            $table->string('status')->nullable();
            $table->integer('cancel_reason_id')->nullable();
            $table->timestamp('ozon_created_at')->nullable();
            $table->timestamp('ozon_in_process_at')->nullable();
            $table->json('products')->nullable();
            $table->json('analytics_data')->nullable();
            $table->json('financial_data')->nullable();
            $table->json('additional_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ozon_fbo_lists');
    }
};
