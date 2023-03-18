<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->char('id',4)->primary();
            $table->string('name_en')->nullable();
            $table->string('name_kh')->nullable();    
            $table->boolean('active')->default(true);
            $table->integer('sort')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->uuid('created_by')->nullable();
        	$table->uuid('updated_by')->nullable();
        	$table->uuid('deleted_by')->nullable(); 
            
            $table->char('province_id',2)->nullable();
            $table->foreign('province_id')->references('id')->on('provinces')->nullOnDelete();
            
            $table->uuid('location_typ_id')->nullable();
            $table->foreign('location_typ_id')->references('id')->on('location_types')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('districts');
    }
}
