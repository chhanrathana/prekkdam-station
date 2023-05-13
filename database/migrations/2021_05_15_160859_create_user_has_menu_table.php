<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserHasMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_has_menu', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->bigInteger('menu_id')->nullable();

            $table->string('status')->default(1);
            $table->string('created_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('user_has_menu');
    }
}
