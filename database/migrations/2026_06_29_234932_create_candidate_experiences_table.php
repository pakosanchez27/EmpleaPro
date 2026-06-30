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
        Schema::create('candidate_experiences', function (Blueprint $table) {
            $table->id();

            $table->foreignId('candidate_profile_id')
                ->constrained('perfil_candidatos')
                ->cascadeOnDelete();

            $table->string('company_name');
            $table->string('position');

            $table->string('work_area')->nullable();
            // desarrollo_web, backend, frontend, soporte_tecnico, etc.

            $table->string('employment_type')->nullable();
            // tiempo_completo, medio_tiempo, practicas, freelance, temporal

            $table->string('location')->nullable();

            $table->string('modality')->nullable();
            // presencial, remoto, hibrido

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->boolean('is_current')->default(false);

            $table->text('description')->nullable();
            $table->text('achievements')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_experiences');
    }
};
