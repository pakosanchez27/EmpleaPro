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
            $table->date('birth_date')->nullable()->after('phone');
            $table->string('gender', 50)->nullable()->after('birth_date');
            $table->string('city', 120)->nullable()->after('gender');
            $table->string('state', 120)->nullable()->after('city');
            $table->string('address')->nullable()->after('state');
            $table->timestamp('onboarding_completed_at')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'birth_date',
                'gender',
                'city',
                'state',
                'address',
                'onboarding_completed_at',
            ]);
        });
    }
};
