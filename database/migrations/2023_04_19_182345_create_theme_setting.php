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
        Schema::create('theme_setting', function (Blueprint $table) {
            $table->id();
            $table->string('theme')->nullable();
            $table->string('light_sidebar')->nullable();
            $table->string('gradient')->nullable();
            $table->string('darkmode')->nullable();
            $table->string('rtl_mode')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('theme_setting');
    }
};
