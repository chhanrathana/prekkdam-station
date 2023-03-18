<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetailSaleProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retail_sale_products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->double('qty')->nullable();
            $table->double('unit_price')->nullable()->default(0);
            $table->double('total_price')->nullable()->default(0);
            $table->double('adjust_qty')->nullable();
            $table->double('adjust_unit_price')->nullable()->default(0);
            $table->double('adjust_total_price')->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->uuid('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->nullOnDelete();
            $table->uuid('retail_sale_id')->nullable();
            $table->foreign('retail_sale_id')->references('id')->on('retail_sales')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('retail_sale_products');
    }
}
