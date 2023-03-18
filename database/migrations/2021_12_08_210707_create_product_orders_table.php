<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('order_date')->nullable();
            $table->decimal('qty')->nullable();
            $table->decimal('unit_cost')->nullable()->default(0);
            $table->decimal('total_cost')->nullable()->default(0);
            $table->string('description',500)->nullable();
            $table->integer('status_id')->default(0);
            $table->boolean('active')->default(true);
            $table->integer('sort')->nullable();
            $table->decimal('remain_qty')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->uuid('created_by')->nullable();
        	$table->uuid('updated_by')->nullable();
        	$table->uuid('deleted_by')->nullable();

            $table->uuid('vehicle_id')->nullable();
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->nullOnDelete();

            $table->uuid('driver_id')->nullable();
            $table->foreign('driver_id')->references('id')->on('shareholders')->nullOnDelete();

            $table->uuid('vendor_id')->nullable();
            $table->foreign('vendor_id')->references('id')->on('shareholders')->nullOnDelete();

            $table->uuid('unit_type_id')->nullable();
            $table->foreign('unit_type_id')->references('id')->on('unit_types')->nullOnDelete();

            $table->uuid('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->nullOnDelete();

            $table->uuid('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_orders');
    }
}
