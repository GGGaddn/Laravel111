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
        Schema::create('wb_incomes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('incomeId')->nullable();
            $table->string('number', 40)->nullable();
            $table->timestamp('date')->nullable();
            $table->timestampTz('lastChangeDate', 3)->nullable();            
            $table->string('supplierArticle', 75)->nullable();
            $table->string('techSize', 30)->nullable();
            $table->string('barcode', 30)->nullable();            
            $table->integer('quantity')->nullable();            
            $table->decimal('totalPrice')->nullable();
            $table->timestamp('dateClose')->nullable();
            $table->string('warehouseName', 50)->nullable();            
            $table->bigInteger('nmId')->nullable();
            $table->string('status', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wb_incomes');
    }
};
