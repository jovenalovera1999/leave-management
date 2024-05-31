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
        Schema::create('tbl_employees', function (Blueprint $table) {
            $table->id('employee_id');
            $table->string('first_name', 55);
            $table->string('middle_name', 55)->nullable();
            $table->string('last_name', 55);
            $table->string('suffix_name')->nullable();
            $table->unsignedBigInteger('gender_id');
            $table->date('birth_date');
            $table->integer('age');
            $table->string('address', 255);
            $table->string('contact_number', 55);
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('position_id');
            $table->tinyInteger('is_deleted')->default(false);
            $table->timestamps();

            $table->foreign('gender_id')
                ->references('gender_id')
                ->on('tbl_genders')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('department_id')
                ->references('department_id')
                ->on('tbl_departments')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('position_id')
                ->references('position_id')
                ->on('tbl_positions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_employees');
    }
};
