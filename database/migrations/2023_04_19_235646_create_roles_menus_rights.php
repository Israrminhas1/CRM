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
        Schema::create('roles_menus_rights', function (Blueprint $table) {
            $table->integer('menu_id')->unsigned()->index();
            $table->integer('role_id')->unsigned()->index();
            $table->enum('mr_rights', ['N', 'Y'])->default('N');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_menus_rights');
    }
};
