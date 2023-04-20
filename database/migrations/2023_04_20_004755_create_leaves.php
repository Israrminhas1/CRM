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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('type_id');
            $table->string('ispaid');
            $table->date('start_date');
            $table->date('end_date');
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
        Schema::dropIfExists('leaves');
    }
};
