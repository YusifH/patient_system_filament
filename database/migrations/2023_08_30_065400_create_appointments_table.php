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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id')->required();
            $table->unsignedBigInteger('patient_id')->required();
            $table->unsignedBigInteger('first_diagnosis_id')->nullable();
            $table->unsignedBigInteger('second_diagnosis_id')->nullable();
            $table->unsignedBigInteger('third_diagnosis_id')->nullable();
            $table->integer('first_or_second')->required();
            $table->text('appointment_notes')->nullable();
            $table->date('appointment_date')->nullable();
            $table->date('appointment_history')->nullable();
            $table->text('appointment_history_note')->nullable();
            $table->integer('status')->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
