<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevenueItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revenue_items', function (Blueprint $table) {
            $table->uuid('id')->primary();    
            $table->date('date');            
            $table->double('amount')->default(0);       
            $table->string('description', 255);
            $table->timestamps();
            $table->softDeletes();

            $table->uuid('revenue_type_id')->nullable();
            $table->foreign('revenue_type_id')->references('id')->on('revenue_types');

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
        Schema::dropIfExists('revenue_items');
    }
}
