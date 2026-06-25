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
        Schema::table('perfil_candidatos', function (Blueprint $table) {
            $table->string('salary_currency', 3)->nullable()->after('expected_salary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perfil_candidatos', function (Blueprint $table) {
            $table->dropColumn('salary_currency');
        });
    }
};
