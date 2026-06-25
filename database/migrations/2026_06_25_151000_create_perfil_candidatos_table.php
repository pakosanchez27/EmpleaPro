<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('perfil_candidatos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->date('birth_date')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->default('Mexico');
            $table->string('professional_title')->nullable();
            $table->text('professional_summary')->nullable();
            $table->string('work_area')->nullable();
            $table->unsignedTinyInteger('years_experience')->nullable();
            $table->string('education_level')->nullable();
            $table->string('desired_job_type')->nullable();
            $table->string('desired_modality')->nullable();
            $table->decimal('expected_salary', 10, 2)->nullable();
            $table->string('salary_period')->nullable();
            $table->string('availability')->nullable();
            $table->boolean('willing_to_relocate')->default(false);
            $table->string('cv_path')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->unsignedTinyInteger('current_step')->default(1);
            $table->boolean('is_completed')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        $this->copyExistingCandidateData();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfil_candidatos');
    }

    private function copyExistingCandidateData(): void
    {
        $userColumns = collect(Schema::getColumnListing('users'));
        $hasDomicilios = Schema::hasTable('domicilios');

        DB::table('users')->orderBy('id')->chunkById(100, function ($users) use ($userColumns, $hasDomicilios) {
            foreach ($users as $user) {
                $domicilio = $hasDomicilios
                    ? DB::table('domicilios')->where('user_id', $user->id)->first()
                    : null;

                $birthDate = $userColumns->contains('birth_date') ? $user->birth_date : null;
                $professionalTitle = $userColumns->contains('professional_title') ? $user->professional_title : null;
                $professionalSummary = $userColumns->contains('professional_summary') ? $user->professional_summary : null;
                $workArea = $userColumns->contains('labor_area') ? $user->labor_area : null;
                $yearsExperience = $userColumns->contains('years_experience') ? $user->years_experience : null;
                $educationLevel = $userColumns->contains('education_level') ? $user->education_level : null;
                $desiredJobType = $userColumns->contains('desired_employment_type') ? $user->desired_employment_type : null;
                $desiredModality = $userColumns->contains('desired_work_mode') ? $user->desired_work_mode : null;
                $expectedSalary = $userColumns->contains('expected_salary') ? $user->expected_salary : null;
                $availability = $userColumns->contains('availability') ? $user->availability : null;
                $completedAt = $userColumns->contains('onboarding_completed_at') ? $user->onboarding_completed_at : null;

                $currentStep = 1;
                if ($birthDate && $domicilio) {
                    $currentStep = 2;
                }
                if ($professionalTitle && $professionalSummary && $workArea && $yearsExperience !== null && $educationLevel) {
                    $currentStep = 3;
                }
                if ($desiredJobType && $desiredModality && $expectedSalary !== null && $availability) {
                    $currentStep = 4;
                }

                DB::table('perfil_candidatos')->updateOrInsert(
                    ['user_id' => $user->id],
                    [
                        'birth_date' => $birthDate,
                        'city' => $domicilio?->delegacion_municipio,
                        'state' => $domicilio?->estado,
                        'country' => 'Mexico',
                        'professional_title' => $professionalTitle,
                        'professional_summary' => $professionalSummary,
                        'work_area' => $workArea,
                        'years_experience' => $yearsExperience,
                        'education_level' => $educationLevel,
                        'desired_job_type' => $desiredJobType,
                        'desired_modality' => $desiredModality,
                        'expected_salary' => $expectedSalary,
                        'salary_period' => null,
                        'availability' => $availability,
                        'willing_to_relocate' => false,
                        'cv_path' => null,
                        'is_visible' => true,
                        'current_step' => $currentStep,
                        'is_completed' => $completedAt !== null,
                        'completed_at' => $completedAt,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        });
    }
};
