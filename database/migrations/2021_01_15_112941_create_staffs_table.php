<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name_en', 255)->nullable();
            $table->string('name_kh', 255);
            $table->date('date_of_birth');
            $table->string('phone_number',50)->nullable();
            $table->date('start_work_date')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->string('status',10)->nullable();
            $table->foreign('status')->references('id')->on('staff_status');

            $table->char('sex',1)->nullable();
            $table->foreign('sex')->references('id')->on('sexes');

            $table->uuid('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staffs');
    }
}
