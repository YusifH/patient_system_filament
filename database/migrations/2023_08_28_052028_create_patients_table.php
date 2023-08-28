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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->int('register_no');
            $table->date('first_application');
            $table->text('sending_medical');
            $table->text('fullname');
            $table->enum('gender', ['q', 'k', ''])->default('');
            $table->date('birth_date');
            $table->unsignedBigInteger('city_id');
            $table->text('actual_address');
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->text('fathername');
            $table->text('father_bad_habit')->nullable();
            $table->text('father_work')->nullable();
            $table->text('mothername');
            $table->text('mother_bad_habit')->nullable();
            $table->text('mother_work')->nullable();
            $table->enum('material_status', ['0', '1'])->nullable();
            $table->text('family_members')->nullable();
            $table->text('qohumluq_elaqesi_etrafli')->nullable();
            $table->text('hamilelik_nece_kecib_detalli')->nullable();
            $table->text('consanguinity_of_parents', ['Yox', 'Hə'])->nullable();
            $table->text('other_patients_in_the_family')->nullable();
            $table->text('the_course_of_childbirth')->nullable();
            $table->enum('how_was_the_pregnancy', ['Normal', 'Fəsadlı'])->nullable();
            $table->int('necenci_hamilelik')->nullable();
            $table->string('child_weight')->nullable();
            $table->string('child_height')->nullable();
            $table->enum('artificial_respiration', ['0', '1'])->default('0')->nullable();
            $table->string('start_walking')->nullable();
            $table->string('start_speaking')->nullable();
            $table->text('vaccination')->nullable();
            $table->text('infectious_disease')->nullable();
            $table->text('medicine')->nullable();
            $table->enum('registered_psychoneurologist', ['0', '1'])->default('0')->nullable();
            $table->enum('genetik_analiz', ['0', '1'])->default('0')->nullable();
            $table->text('pediatrician_notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
