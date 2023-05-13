<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urls', function (Blueprint $table) {
            $table->char('id', 6)->primary();
            $table->enum('method', ['GET', 'POST', 'PATCH', 'DELETE']);            
            $table->string('uri', 255);
            $table->string('route_name', 255);
            $table->boolean('acitve')->default(1);
            $table->boolean('is_menu')->default(1);
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
        Schema::dropIfExists('urls');
    }
}
