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
        if (Schema::hasColumn('users', 'last_name')) {
            DB::table('users')
                ->whereNotNull('last_name')
                ->where('last_name', '!=', '')
                ->orderBy('id')
                ->chunkById(100, function ($users) {
                    foreach ($users as $user) {
                        DB::table('users')->where('id', $user->id)->update([
                            'name' => trim($user->name . ' ' . $user->last_name),
                        ]);
                    }
                });
        }

        $columns = collect([
            'last_name',
            'birth_date',
            'gender',
            'professional_title',
            'professional_summary',
            'labor_area',
            'years_experience',
            'education_level',
            'desired_employment_type',
            'desired_work_mode',
            'expected_salary',
            'availability',
            'professional_profile_completed_at',
            'job_preferences_completed_at',
            'onboarding_completed_at',
        ])->filter(fn (string $column) => Schema::hasColumn('users', $column))->values()->all();

        if ($columns !== []) {
            Schema::table('users', function (Blueprint $table) use ($columns) {
                $table->dropColumn($columns);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'last_name')) {
                $table->string('last_name')->nullable()->after('name');
            }
            if (! Schema::hasColumn('users', 'birth_date')) {
                $table->date('birth_date')->nullable()->after('phone');
            }
            if (! Schema::hasColumn('users', 'gender')) {
                $table->string('gender', 50)->nullable()->after('birth_date');
            }
            if (! Schema::hasColumn('users', 'professional_title')) {
                $table->string('professional_title', 160)->nullable()->after('gender');
            }
            if (! Schema::hasColumn('users', 'professional_summary')) {
                $table->text('professional_summary')->nullable()->after('professional_title');
            }
            if (! Schema::hasColumn('users', 'labor_area')) {
                $table->string('labor_area', 120)->nullable()->after('professional_summary');
            }
            if (! Schema::hasColumn('users', 'years_experience')) {
                $table->unsignedTinyInteger('years_experience')->nullable()->after('labor_area');
            }
            if (! Schema::hasColumn('users', 'education_level')) {
                $table->string('education_level', 120)->nullable()->after('years_experience');
            }
            if (! Schema::hasColumn('users', 'desired_employment_type')) {
                $table->string('desired_employment_type', 80)->nullable()->after('education_level');
            }
            if (! Schema::hasColumn('users', 'desired_work_mode')) {
                $table->string('desired_work_mode', 80)->nullable()->after('desired_employment_type');
            }
            if (! Schema::hasColumn('users', 'expected_salary')) {
                $table->decimal('expected_salary', 10, 2)->nullable()->after('desired_work_mode');
            }
            if (! Schema::hasColumn('users', 'availability')) {
                $table->string('availability', 80)->nullable()->after('expected_salary');
            }
            if (! Schema::hasColumn('users', 'professional_profile_completed_at')) {
                $table->timestamp('professional_profile_completed_at')->nullable()->after('availability');
            }
            if (! Schema::hasColumn('users', 'job_preferences_completed_at')) {
                $table->timestamp('job_preferences_completed_at')->nullable()->after('professional_profile_completed_at');
            }
            if (! Schema::hasColumn('users', 'onboarding_completed_at')) {
                $table->timestamp('onboarding_completed_at')->nullable()->after('job_preferences_completed_at');
            }
        });
    }
};
