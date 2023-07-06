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
            $table->double('qty',5)->default(0);
            $table->enum('unit', ['T', 'L'])->default('T');
            $table->double('cost',5)->default(0);
            $table->enum('currency', ['usd', 'khr'])->default('usd');
            $table->double('exchange_rate',5)->default(0);
            $table->double('total_cost',2)->virtualAs('cost * qty');
            $table->double('paid_amount',5)->default(0);
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->string('oil_type_id',10)->nullable();
            $table->foreign('oil_type_id')->references('id')->on('oil_types');     
            $table->string('status_id',10)->nullable();
            $table->foreign('status_id')->references('id')->on('oil_status');     

            $table->uuid('vendor_id')->nullable();
            $table->foreign('vendor_id')->references('id')->on('vendors');

            $table->uuid('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches');

            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('tank_id',5)->nullable();
            $table->foreign('tank_id')->references('id')->on('tanks');
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
