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
        Schema::create('wb_report_detail_by_periods', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('realizationreport_id')->nullable();  
            $table->timestampTz('date_from')->nullable();  
            $table->timestampTz('date_to')->nullable();  
            $table->timestamp('create_dt')->nullable();  
            $table->json('suppliercontract_code')->nullable();  
            $table->bigInteger('rrd_id')->nullable();  
            $table->bigInteger('gi_id')->nullable();              
            $table->string('subject_name')->nullable();               
            $table->bigInteger('nm_id')->nullable();  
            $table->string('brand_name')->nullable(); 
            $table->string('sa_name')->nullable(); 
            $table->string('ts_name')->nullable(); 
            $table->string('barcode')->nullable(); 
            $table->string('doc_type_name')->nullable(); 
            $table->integer('quantity')->nullable();              
            $table->decimal('retail_price')->nullable(); 
            $table->decimal('retail_amount')->nullable();             
            $table->integer('sale_percent')->nullable();
            $table->decimal('commission_percent')->nullable();             
            $table->string('office_name')->nullable(); 
            $table->string('supplier_oper_name')->nullable(); 
            $table->timestamp('order_dt')->nullable(); 
            $table->timestamp('sale_dt')->nullable(); 
            $table->timestamp('rr_dt')->nullable(); 
            $table->bigInteger('shk_id')->nullable(); 
            $table->decimal('retail_price_withdisc_rub')->nullable(); 
            $table->integer('delivery_amount')->nullable(); 
            $table->integer('return_amount')->nullable(); 
            $table->decimal('delivery_rub')->nullable();              
            $table->string('gi_box_type_name')->nullable(); 
            $table->decimal('product_discount_for_report')->nullable();
            $table->decimal('supplier_promo')->nullable();            
            $table->bigInteger('rid')->nullable();
            $table->decimal('ppvz_spp_prc')->nullable();
            $table->decimal('ppvz_kvw_prc_base')->nullable();
            $table->decimal('ppvz_kvw_prc')->nullable();
            $table->decimal('ppvz_sales_commission')->nullable();
            $table->decimal('ppvz_for_pay')->nullable();
            $table->decimal('ppvz_reward')->nullable();
            $table->decimal('acquiring_fee')->nullable();            
            $table->string('acquiring_bank')->nullable();
            $table->decimal('ppvz_vw')->nullable();
            $table->decimal('ppvz_vw_nds')->nullable();
            $table->bigInteger('ppvz_office_id')->nullable();
            $table->string('ppvz_office_name')->nullable();            
            $table->bigInteger('ppvz_supplier_id')->nullable();
            $table->string('ppvz_supplier_name')->nullable();
            $table->string('ppvz_inn')->nullable();
            $table->string('declaration_number')->nullable();
            $table->string('bonus_type_name')->nullable();
            $table->string('sticker_id')->nullable();
            $table->string('site_country')->nullable();
            $table->decimal('penalty')->nullable();
            $table->decimal('additional_payment')->nullable();
            $table->string('kiz')->nullable();
            $table->string('srid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wb_report_detail_by_periods');
    }
};
