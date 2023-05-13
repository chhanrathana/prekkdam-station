<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_payments', function (Blueprint $table) {

            $table->uuid('id')->primary();
            $table->datetime('transaction_datetime')->nullable();
            $table->double('principal_amount')->default(0);
            $table->double('admin_fee_amount')->default(0);
            $table->date('start_interest_date');
            $table->date('end_interest_date');
            $table->integer('interval');
            $table->double('interest_rate')->default(0);
            $table->double('interest_amount')->default(0);
            $table->double('interest_paid_amount')->default(0);
            $table->double('interest_pending_amount')->default(0);
            $table->double('deduct_amount')->default(0);
            $table->double('deduct_paid_amount')->default(0);
            $table->double('deduct_pending_amount')->default(0);
            $table->double('loan_amount')->default(0)->comment('add new loan amount');
            $table->double('balance_amount')->default(0);
            $table->timestamps();
            $table->softDeletes();
            
            // $table->integer('sort');
            // $table->integer('interval');
            // $table->date('start_end_interest_date');
            // $table->date('end_interest_date');
            // $table->date('last_payment_paid_date')->nullable();
            // $table->double('deduct_amount');
            // $table->double('deduct_paid_amount')->default(0);
            // $table->double('deduct_pending_amount')->default(0);
            // $table->double('commission_amount')->default(0);            
            // $table->double('interest_amount');                        
            // $table->double('interest_paid_amount')->default(0);
            // $table->double('interest_pending_amount')->default(0);
            // $table->double('total_amount');
            // $table->double('total_paid_amount')->default(0);
            // $table->double('pending_amount');
            // $table->string('remark')->nullable();
            

            $table->uuid('loan_id')->nullable();
            $table->foreign('loan_id')->references('id')->on('loans');

            $table->string('status',10)->nullable();
            $table->foreign('status')->references('id')->on('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_payments');
    }
}
