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
        Schema::create('wb_orders', function (Blueprint $table) {
            $table->id();
            $table->string('gNumber', 50)->nullable();            
            $table->timestamp('date')->nullable();            
            $table->timestamp('lastChangeDate')->nullable();
            $table->string('supplierArticle', 75)->nullable();
            $table->string('techSize', 30)->nullable();
            $table->string('barcode', 30)->nullable(); 
            $table->decimal('totalPrice')->nullable();
            $table->integer('discountPercent')->nullable();
            $table->string('warehouseName', 50)->nullable();
            $table->string('oblast', 200)->nullable();            
            $table->bigInteger('incomeID')->nullable();  
            $table->bigInteger('odid')->nullable();  
            $table->bigInteger('nmId')->nullable();  
            $table->string('subject', 50)->nullable();
            $table->string('category', 50)->nullable();
            $table->string('brand', 50)->nullable();            
            $table->boolean('isCancel')->nullable();
            $table->timestamp('cancel_dt')->nullable();
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
        Schema::dropIfExists('wb_orders');
    }
};
