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
        Schema::create('candidate_educations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('candidate_profile_id')
                ->constrained('perfil_candidatos')
                ->cascadeOnDelete();

            $table->string('institution_name');

            $table->string('education_level');
            // secundaria, bachillerato, tecnico, tsu, licenciatura, maestria, doctorado, curso, certificacion

            $table->string('field_of_study')->nullable();
            // Desarrollo de Software, Informática, Administración, etc.

            $table->string('status')->nullable();
            // cursando, terminado, trunco

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->boolean('is_current')->default(false);

            $table->text('description')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_educations');
    }
};
