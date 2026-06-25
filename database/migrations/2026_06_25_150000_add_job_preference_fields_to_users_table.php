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
        Schema::table('users', function (Blueprint $table) {
            $table->string('desired_employment_type', 80)->nullable()->after('professional_profile_completed_at');
            $table->string('desired_work_mode', 80)->nullable()->after('desired_employment_type');
            $table->decimal('expected_salary', 10, 2)->nullable()->after('desired_work_mode');
            $table->string('availability', 80)->nullable()->after('expected_salary');
            $table->timestamp('job_preferences_completed_at')->nullable()->after('availability');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'desired_employment_type',
                'desired_work_mode',
                'expected_salary',
                'availability',
                'job_preferences_completed_at',
            ]);
        });
    }
};
