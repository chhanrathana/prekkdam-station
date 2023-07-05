<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('code',6);
            $table->string('name_en', 50);
            $table->string('name_kh', 50);
            $table->date('date_of_birth')->nullable();
            $table->string('phone_number', 50);
            $table->string('id_card_no', 20)->nullable();
            $table->string('photo')->nullable();
            $table->string('address', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->char('sex',1)->nullable();
            $table->foreign('sex')->references('id')->on('sexes');

            $table->string('status',10)->nullable();
            $table->foreign('status')->references('id')->on('vendor_status');

            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('village_id', 10)->nullable();
            $table->foreign('village_id')->references('id')->on('villages');

            $table->uuid('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches');
            
            $table->unique(['code','branch_id'],'vendor_code_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendors');
    }
}
