<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentRevenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_revenues', function (Blueprint $table) {
            $table->uuid('id')->primary();            
            $table->date('transaction_date');
            $table->double('admin_fee_amount')->default(0);
            $table->double('interest_amount')->default(0);
            $table->double('commission_amount')->default(0);
            $table->double('amount')->default(0);            
            $table->datetime('setlement_datetime')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->uuid('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches');

            $table->unique(['transaction_date', 'branch_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_revenues');
    }
}
