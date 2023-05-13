<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code', 50);
            $table->date('registration_date')->nullable();
            $table->double('principal_amount')->default(0);
            $table->double('admin_fee_amount')->default(0);
            $table->integer('term')->default(0);
            $table->date('start_interest_date')->nullable();
            $table->double('interest_rate')->default(0);
            $table->date('update_balance_date')->nullable();
            $table->double('balance_amount')->default(0);
            $table->date('finish_date')->nullable();
            
            $table->timestamps();
            $table->softDeletes();

            $table->string('status',10)->nullable();
            $table->foreign('status')->references('id')->on('loan_status');

            $table->uuid('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('clients');

            $table->uuid('staff_id')->nullable();
            $table->foreign('staff_id')->references('id')->on('staffs');

            $table->string('loan_type_id',10)->nullable();
            $table->foreign('loan_type_id')->references('id')->on('loan_types');

            $table->uuid('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches');

            $table->unique(['code','branch_id'],'loans_code_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
