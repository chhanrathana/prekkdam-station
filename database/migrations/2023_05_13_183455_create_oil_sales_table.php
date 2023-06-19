<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOilSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oil_sales', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('code', 5)->unique();
            $table->date('sale_date');
            $table->double('old_capacitor_r',10)->default(0);
            $table->double('new_capacitor_r',10)->default(0);
            $table->double('qty_liter_r',10)->default(0);
            $table->double('old_capacitor_l',10)->default(0);
            $table->double('new_capacitor_l',10)->default(0);
            $table->double('qty_liter_l',10)->default(0);            
            $table->double('total_qty_liter',10)->default(0);
            $table->double('total_qty_ton',10)->default(0);            
            $table->double('sale_price_khr',10)->default(0);
            $table->double('sale_price_usd',10)->default(0);
            $table->double('total_sale_price_khr',10)->default(0);
            $table->double('total_sale_price_usd',10)->default(0);
            
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->uuid('oil_purchase_id')->nullable();
            $table->foreign('oil_purchase_id')->references('id')->on('oil_purchases');
            $table->string('work_shift_id',10)->nullable();
            $table->foreign('work_shift_id')->references('id')->on('work_shifts');     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oil_sales');
    }
}
