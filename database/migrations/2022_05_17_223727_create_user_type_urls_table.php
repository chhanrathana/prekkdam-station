<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTypeUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_type_urls', function (Blueprint $table) {
            $table->char('user_type_id',1)->nullable();
            $table->foreign('user_type_id')->references('id')->on('user_types');

            $table->char('url_id',6)->nullable();
            $table->foreign('url_id')->references('id')->on('urls');     
            
            $table->unique(['user_type_id', 'url_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_type_urls');
    }
}
