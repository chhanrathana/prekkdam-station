<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('code',5)->unique();
            $table->string('name_en')->nullable();
            $table->string('name_kh')->nullable();
            // $table->string('unit_kh',50)->nullable();
            // $table->string('unit_en',50)->nullable();
            $table->decimal('cost')->nullable()->default(0);
            $table->decimal('price')->nullable()->default(0);
            $table->string('currency',5)->nullable()->default('KHR');
            $table->string('avatar')->nullable();
            $table->string('description',500)->nullable();
            $table->boolean('active')->default(true);
            $table->integer('sort')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->uuid('created_by')->nullable();
        	$table->uuid('updated_by')->nullable();
        	$table->uuid('deleted_by')->nullable();

            $table->uuid('unit_id')->nullable();
            $table->foreign('unit_id')->references('id')->on('units')->nullOnDelete();

            $table->uuid('product_type_id')->nullable();            
            $table->foreign('product_type_id')->references('id')->on('product_types')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
