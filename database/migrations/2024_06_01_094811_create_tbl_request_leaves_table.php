<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_request_leaves', function (Blueprint $table) {
            $table->id('request_leave_id');
            $table->unsignedBigInteger('employee_id');
            $table->double('regular_salary')->default(0);
            $table->date('regular_schedule_date_from');
            $table->date('regular_schedule_date_to');
            $table->unsignedBigInteger('leave_id');
            $table->date('leave_date_from');
            $table->date('leave_date_to');
            $table->date('attended_date_from')->nullable();
            $table->date('attended_date_to')->nullable();
            $table->double('salary_deduction_per_day')->default(0);
            $table->double('deducted_salary')->default(0);
            $table->double('final_salary')->default(0);
            $table->double('remaining_days')->default(0);
            $table->tinyInteger('is_deleted')->default(false);
            $table->timestamps();

            $table->foreign('employee_id')
                ->references('employee_id')
                ->on('tbl_employees')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('leave_id')
                ->references('leave_id')
                ->on('tbl_types_of_leave')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_request_leaves');
    }
};
