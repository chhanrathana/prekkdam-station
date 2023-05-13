<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('parent_id')->nullable();
            $table->string('label')->nullable();
            $table->string('url')->nullable();
            $table->string('active_url')->nullable();
            $table->string('permission')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->char('url_id',6)->nullable();
            $table->foreign('url_id')->references('id')->on('urls');

            $table->integer('group_id')->nullable()->unsigned();
            $table->foreign('group_id')->references('id')->on('group_menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
