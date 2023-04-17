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
        Schema::create('wb_sales', function (Blueprint $table) {
            $table->id();
            $table->string('gNumber', 50)->nullable();            
            $table->timestamp('date')->nullable();            
            $table->timestamp('lastChangeDate')->nullable();
            $table->string('supplierArticle', 75)->nullable();
            $table->string('techSize', 30)->nullable();
            $table->string('barcode', 30)->nullable(); 
            $table->decimal('totalPrice')->nullable();
            $table->integer('discountPercent')->nullable();
            $table->boolean('isSupply')->nullable();
            $table->boolean('isRealization')->nullable();
            $table->decimal('promoCodeDiscount')->nullable();
            $table->string('warehouseName', 50)->nullable();
            $table->string('countryName', 200)->nullable(); 
            $table->string('oblastOkrugName', 200)->nullable(); 
            $table->string('regionName', 200)->nullable();             
            $table->bigInteger('incomeID')->nullable(); 
            $table->string('saleID', 15)->nullable(); 
            $table->bigInteger('odid')->nullable(); 
            $table->decimal('spp')->nullable(); 
            $table->decimal('forPay')->nullable(); 
            $table->decimal('finishedPrice')->nullable(); 
            $table->decimal('priceWithDisc')->nullable(); 
            $table->bigInteger('nmId')->nullable();  
            $table->string('subject', 50)->nullable();
            $table->string('category', 50)->nullable();
            $table->string('brand', 50)->nullable();
            $table->boolean('isStorno')->nullable();
            $table->string('sticker')->nullable();
            $table->string('srid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wb_sales');
    }
};
