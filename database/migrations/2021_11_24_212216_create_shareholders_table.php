<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShareholdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareholders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code',10)->unique();
            $table->boolean('is_company')->default(false);
            $table->string('name_en')->nullable();
            $table->string('name_kh')->nullable();
            $table->string('phone_number_01',15)->nullable();
            $table->string('phone_number_02',15)->nullable();
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

            $table->string('shareholder_type_id', 50)->nullable();
            $table->foreign('shareholder_type_id')->references('id')->on('shareholder_types')->nullOnDelete();
                        
            $table->char('sex', 1)->nullable();
            $table->foreign('sex')->references('id')->on('sex')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shareholders');
    }
}
