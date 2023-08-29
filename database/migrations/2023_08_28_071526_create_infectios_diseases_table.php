<?php

use App\Models\Patient;
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
        Schema::create('infectios_diseases', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('patient_infectios_diseases', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patient::class)->index();
            $table->foreignIdFor(InfectiosDiseases::class)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infectios_diseases');
        Schema::dropIfExists('patient_infectios_diseases');
    }
};
