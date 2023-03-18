<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOrderFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_order_files', function (Blueprint $table) {
            $table->uuid('product_order_id')->nullable();            
            $table->uuid('file_id')->nullable();            
            $table->foreign('product_order_id')->references('id')->on('product_orders')->nullOnDelete();
            $table->foreign('file_id')->references('id')->on('files')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_order_files');
    }
}
