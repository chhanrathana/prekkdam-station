<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sex', function (Blueprint $table) {
            $table->char('id',1)->primary();
            $table->string('name_en')->nullable();
            $table->string('name_kh')->nullable();
            $table->string('short_kh',10)->nullable();
            $table->string('short_en',10)->nullable();            
            $table->boolean('active')->default(true);
            $table->integer('sort')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->uuid('created_by')->nullable();
        	$table->uuid('updated_by')->nullable();
        	$table->uuid('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sex');
    }
}
