<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();            
            $table->datetime('transaction_datetime');
            $table->double('transaction_amount')->default(0);
            $table->double('deduct_amount')->default(0);
            $table->double('interest_amount')->default(0);
            $table->double('commission_amount')->default(0);
            $table->double('revenue_amount')->default(0);
            $table->datetime('setlement_datetime')->nullable();
            $table->enum('type', ['interest', 'deduction','reverse']);
            $table->timestamps();
            $table->softDeletes();
            
            $table->uuid('payment_id')->nullable();
            $table->foreign('payment_id')->references('id')->on('loan_payments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_transactions');
    }
}
