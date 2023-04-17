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
        Schema::create('wb_stocks', function (Blueprint $table) {
            $table->id();
            $table->timestamp('lastChangeDate')->nullable();
            $table->string('supplierArticle', 75)->nullable();
            $table->string('techSize', 30)->nullable();
            $table->string('barcode', 30)->nullable(); 
            $table->integer('quantity')->nullable();             
            $table->boolean('isSupply')->nullable();
            $table->boolean('isRealization')->nullable();
            $table->integer('quantityFull')->nullable();             
            $table->string('warehouseName', 50)->nullable();
            $table->bigInteger('nmId')->nullable();  
            $table->string('subject', 50)->nullable();
            $table->string('category', 50)->nullable();
            $table->integer('daysOnSite')->nullable(); 
            $table->string('brand', 50)->nullable();
            $table->string('SCCode', 50)->nullable();
            $table->decimal('Price')->nullable();
            $table->decimal('Discount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wb_stocks');
    }
};
