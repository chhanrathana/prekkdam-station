<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterestRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interest_rates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code', 50);
            $table->string('name', 100);
            $table->double('rate', 8, 2);
            $table->double('commission_rate', 8, 2);
            $table->integer('interval');
            $table->integer('sort');
            $table->string('css', 50)->nullable();
            $table->json('setting')->nullable();
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
        Schema::dropIfExists('interest_rates');
    }
}
