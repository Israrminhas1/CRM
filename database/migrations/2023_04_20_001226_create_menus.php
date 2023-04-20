<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url')->nullable();
            $table->integer('icon_type')->nullable();
            $table->string('icon_image')->nullable();
            $table->integer('is_parent');
            $table->integer('sort_order');
            $table->integer('is_enabled');
            $table->integer('is_new_tab');
            $table->integer('is_listable');
            $table->integer('is_dropdown');
            $table->timestamps();
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
};
