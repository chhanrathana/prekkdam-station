<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->date('date');
            $table->double('qty',2)->default(0);
            $table->enum('unit', ['tons', 'liters'])->default('tons');
            $table->double('remain_qty',2)->default(0);
            $table->double('cost',2)->default(0);
            $table->enum('currency', ['usd', 'khr'])->default('usd');
            $table->double('exchange_rate',2)->default(0);
            $table->double('total_cost',2)->virtualAs('cost * qty');
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->string('oil_type_id',2)->nullable();
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
