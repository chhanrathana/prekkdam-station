<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name_en')->nullable();
            $table->string('name_kh')->nullable();
            $table->boolean('active')->default(true);
            $table->integer('sort')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->uuid('created_by')->nullable();
        	$table->uuid('updated_by')->nullable();
        	$table->uuid('deleted_by')->nullable();

            $table->string('home_number', 50)->nullable();
            $table->string('street_number', 50)->nullable();
            $table->string('address_detail', 50)->nullable();
            $table->char('province_id', 2)->nullable();
            $table->foreign('province_id')->references('id')->on('provinces')->nullOnDelete();
            $table->char('district_id', 4)->nullable();
            $table->foreign('district_id')->references('id')->on('districts')->nullOnDelete();
            $table->string('commune_id', 10)->nullable();            
            $table->foreign('commune_id')->references('id')->on('communes')->nullOnDelete();
            $table->string('village_id', 10)->nullable();
            $table->foreign('village_id')->references('id')->on('villages')->nullOnDelete();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branches');
    }
}
