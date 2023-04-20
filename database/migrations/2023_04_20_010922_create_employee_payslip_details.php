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
        Schema::create('employee_payslip_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('payslip_id')->unsigned()->index();
            $table->string('title')->nullable();
            $table->date('date')->nullable();
            $table->double('amount');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('employee_payslip_details');
    }
};
