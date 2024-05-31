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
        Schema::create('tbl_applies', function (Blueprint $table) {
            $table->id('apply_id');
            $table->unsignedBigInteger('employee_id');
            $table->date('date_from');
            $table->date('date_to');
            $table->double('regular_balance')->default(0);
            $table->double('remaining_balance')->default(0);
            $table->tinyInteger('is_approved')->default(false);
            $table->tinyInteger('is_deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_applies');
    }
};
