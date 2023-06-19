<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOilPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oil_purchases', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('code', 5)->unique();
            $table->date('purchase_date');
            $table->double('qty_ton',10)->default(0);
            $table->double('qty_liter',10)->default(0);

            $table->double('pending_qty_ton',10)->default(0);
            $table->double('pending_qty_liter',10)->default(0);

            $table->double('cost_usd',10)->default(0);
            $table->double('cost_khr',10)->default(0);
            $table->double('total_cost_usd',10)->default(0);
            $table->double('total_cost_khr',10)->default(0);
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->string('oil_type_id',10)->nullable();
            $table->foreign('oil_type_id')->references('id')->on('oil_types');     
            $table->string('status_id',10)->nullable();
            $table->foreign('status_id')->references('id')->on('oil_status');     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oil_purchases');
    }
}
