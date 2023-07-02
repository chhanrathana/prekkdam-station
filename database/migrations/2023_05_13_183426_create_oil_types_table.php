<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOilTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oil_types', function (Blueprint $table) {
            $table->string('id',10)->primary();
            $table->string('name_kh')->nullable();
            $table->string('name_en')->nullable();
            $table->integer('liter_of_ton')->default(0)->comment('liters of a ton');            
            $table->boolean('active')->default(1);
            $table->string('css')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oil_types');
    }
}
