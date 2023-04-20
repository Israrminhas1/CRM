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
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('attendance_type', 255);
            $table->date('attendance_date')->nullable();
            $table->string('attendance_time', 255)->nullable();
            $table->string('status', 255)->default('pending');
            $table->string('comment', 255)->nullable();
            $table->string('reject_reason', 255)->nullable();
            $table->timestamp('created_on')->useCurrent()->nullable();
            $table->integer('created_by');
            $table->dateTime('updated_on')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance');
    }
};
