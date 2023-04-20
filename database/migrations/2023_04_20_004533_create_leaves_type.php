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
        Schema::create('leaves_type', function (Blueprint $table) {
            $table->id();
            $table->string('type_name');
            $table->string('is_deleted')->default('N');
            $table->integer('created_by');
            $table->timestamp('created_on');
            $table->integer('updated_by')->nullable();
            $table->date('updated_on')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leaves_type');
    }
};
