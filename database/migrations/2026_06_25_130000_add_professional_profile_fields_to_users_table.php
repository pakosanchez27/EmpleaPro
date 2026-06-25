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
            $table->string('professional_title', 160)->nullable()->after('onboarding_completed_at');
            $table->text('professional_summary')->nullable()->after('professional_title');
            $table->string('labor_area', 120)->nullable()->after('professional_summary');
            $table->unsignedTinyInteger('years_experience')->nullable()->after('labor_area');
            $table->string('education_level', 120)->nullable()->after('years_experience');
            $table->timestamp('professional_profile_completed_at')->nullable()->after('education_level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'professional_title',
                'professional_summary',
                'labor_area',
                'years_experience',
                'education_level',
                'professional_profile_completed_at',
            ]);
        });
    }
};
