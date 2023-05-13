<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->datetime('transaction_datetime')->nullable();
            $table->double('principal_amount')->default(0);
            $table->date('start_interest_date');
            $table->date('end_interest_date');
            $table->integer('interval');
            $table->double('interest_rate')->default(0);
            $table->double('interest_amount')->default(0);
            $table->double('withdraw_amount')->default(0);
            $table->double('deposit_amount')->default(0);
            $table->double('balance_amount')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->uuid('membership_id')->nullable();
            $table->foreign('membership_id')->references('id')->on('memberships');

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
        Schema::dropIfExists('membership_payments');
    }
}
