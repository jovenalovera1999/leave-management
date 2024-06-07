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
            $table->unsignedBigInteger('leave_id');
            $table->date('leave_date_from');
            $table->date('leave_date_to');
            $table->tinyInteger('is_with_pay')->default(false);
            $table->tinyInteger('is_approved')->default(false);
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
