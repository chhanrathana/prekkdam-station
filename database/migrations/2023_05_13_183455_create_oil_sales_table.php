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
            $table->date('date');
            $table->double('old_motor_right',2)->default(0);
            $table->double('new_motor_right',2)->default(0);
            $table->double('old_motor_left',2)->default(0);
            $table->double('new_motor_left',2)->default(0);
            $table->double('qty',2)->virtualAs('(new_motor_right - old_motor_right) + (new_motor_left - old_motor_left)');
            $table->enum('unit', ['tons', 'liters'])->default('liters');
            $table->double('cost',2)->default(0);
            $table->double('price',2)->default(0);
            $table->double('total_cost',2)->virtualAs('(cost * qty)');
            $table->double('total_price',2)->virtualAs('(price * qty)');
            $table->enum('currency', ['usd', 'khr'])->default('khr');
            $table->double('exchange_rate',2)->default(0);
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
