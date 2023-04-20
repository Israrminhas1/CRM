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
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('full_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('basic_salary');
            $table->integer('salary')->default(0);
            $table->integer('BreakUpTypeId')->default(0);
            $table->date('dob')->nullable();
            $table->text('emp_address')->nullable();
            $table->enum('gender', ['M', 'F', 'O'])->default('M');
            $table->string('mobile_phone')->nullable();
            $table->string('country');
            $table->string('country_phone')->nullable();
            $table->string('contact_name')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('designation')->nullable();
            $table->string('visa_title')->nullable();
            $table->date('joining_date')->nullable();
            $table->date('visa_expiry_date')->nullable();
            $table->integer('notify')->default(0);
            $table->text('attachment')->nullable();
            $table->enum('status', ['active', 'inactive', 'fired', 'resign'])->default('active');
            $table->date('ending_date')->nullable();
            $table->text('reason')->nullable();
            $table->text('status_attachment')->nullable();
            $table->date('created_on')->nullable();
            $table->unsignedBigInteger('created_by')->default(0);
            $table->date('modified_on')->nullable();
            $table->unsignedBigInteger('modified_by')->default(0);
            $table->enum('is_deleted', ['N', 'Y'])->default('N');
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
        Schema::dropIfExists('employes');
    }
};
