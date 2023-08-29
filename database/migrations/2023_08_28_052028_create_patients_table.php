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
            $table->integer('register_no');
            $table->date('first_application');
            $table->text('sending_medical');
            $table->text('fullname');
            $table->text('gender')->nullable();
            $table->date('birth_date');
            $table->unsignedBigInteger('city_id');
            $table->text('actual_address')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->text('fathername');
            $table->text('father_bad_habit')->nullable();
            $table->text('father_work')->nullable();
            $table->text('mothername');
            $table->text('mother_bad_habit')->nullable();
            $table->text('mother_work')->nullable();
            $table->text('material_status')->nullable();
            $table->text('family_members')->nullable();
            $table->text('qohumluq_elaqesi_etrafli')->nullable();
            $table->text('hamilelik_nece_kecib_detalli')->nullable();
            $table->text('consanguinity_of_parents')->nullable();
            $table->text('other_patients_in_the_family')->nullable();
            $table->text('how_was_the_pregnancy')->nullable();
            $table->integer('necenci_hamilelik')->nullable();
            $table->string('child_weight')->nullable();
            $table->string('child_height')->nullable();
            $table->text('artificial_respiration')->nullable();
            $table->string('start_walking')->nullable();
            $table->string('start_speaking')->nullable();
            $table->text('vaccination')->nullable();
            $table->text('medicine')->nullable();
            $table->text('registered_psychoneurologist')->nullable();
            $table->text('genetik_analiz')->nullable();
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
