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
        Schema::create('employee_salary', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('payslip_no')->nullable();
            $table->integer('employee_id')->unsigned();
            $table->double('gross_salary');
            $table->double('approved_salary');
            $table->double('absent_deduction')->nullable();
            $table->double('leave_deduction')->nullable();
            $table->integer('leaves')->nullable();
            $table->integer('absents')->nullable();
            $table->double('total_allowance')->default(0);
            $table->double('total_deduction')->default(0);
            $table->double('net_amount');
            $table->date('dated')->nullable();
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
        Schema::dropIfExists('employee_salary');
    }
};
