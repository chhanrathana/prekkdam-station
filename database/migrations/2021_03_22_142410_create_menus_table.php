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
            $table->uuid('id')->primary();
            $table->uuid('parent_id')->nullable();
            $table->uuid('group_id')->nullable();
            $table->string('label', 250)->nullable();
            $table->string('url', 250)->nullable();
            $table->string('active_url', 250)->nullable();
            $table->string('permission', 250)->nullable();
            $table->string('icon', 250)->nullable();
            $table->integer('sort')->default(0);
            $table->boolean('visible')->default(1);
            $table->timestamps();
            $table->softDeletes();            
            $table->foreign('group_id')->references('id')->on('group_menus')->nullOnDelete();
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
