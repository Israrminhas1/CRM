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
        Schema::create('employee_payroll', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('payslip_no');
            $table->integer('employee_id');
            $table->string('date');
            $table->double('gross_salary');
            $table->double('approved_salary');
            $table->double('total_allowances')->nullable();
            $table->double('total_deductions')->nullable();
            $table->double('total_absent_deduction')->nullable();
            $table->double('total_leave_deduction')->nullable();
            $table->double('net_amount');
            $table->string('is_deleted')->default('N');
            $table->timestamp('created_on')->useCurrent()->nullable();
            $table->integer('created_by');
            $table->datetime('updated_on')->nullable();
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
        Schema::dropIfExists('employee_payroll');
    }
};
