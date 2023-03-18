<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWholesalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wholesales', function (Blueprint $table) {            
            $table->uuid('id')->primary();
            $table->char('code',13)->unique();
            $table->date('order_date')->nullable();            
            $table->boolean('active')->default(true);
            $table->integer('sort')->nullable();
            
            $table->double('total_amount')->default(0);

            $table->double('adjust_total_amount')->default(0);
            $table->double('paid_amount')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->uuid('created_by')->nullable();
        	$table->uuid('updated_by')->nullable();
        	$table->uuid('deleted_by')->nullable();

            $table->uuid('vehicle_id')->nullable();
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->nullOnDelete();

            $table->uuid('driver_id')->nullable();
            $table->foreign('driver_id')->references('id')->on('shareholders')->nullOnDelete();

            $table->uuid('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('shareholders')->nullOnDelete();

            $table->integer('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('wholesale_status')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wholesales');
    }
}
