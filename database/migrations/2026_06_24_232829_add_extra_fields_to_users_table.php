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
            // Estado del usuario
            $table->boolean('is_active')
                ->default(true)
                ->after('remember_token');

            // Seguridad y auditoría de acceso
            $table->timestamp('last_login_at')
                ->nullable()
                ->after('is_active');

            $table->timestamp('password_changed_at')
                ->nullable()
                ->after('last_login_at');

            $table->unsignedSmallInteger('failed_login_attempts')
                ->default(0)
                ->after('password_changed_at');

            $table->timestamp('locked_until')
                ->nullable()
                ->after('failed_login_attempts');

            // Perfil opcional
            $table->string('phone')
                ->nullable()
                ->after('locked_until');

            $table->string('avatar')
                ->nullable()
                ->after('phone');

            // Auditoría de creación / edición
            $table->foreignId('created_by')
                ->nullable()
                ->after('avatar')
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('updated_by')
                ->nullable()
                ->after('created_by')
                ->constrained('users')
                ->nullOnDelete();

            // Borrado lógico
            $table->softDeletes()
                ->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);

            $table->dropColumn([
                'is_active',
                'last_login_at',
                'password_changed_at',
                'failed_login_attempts',
                'locked_until',
                'phone',
                'avatar',
                'created_by',
                'updated_by',
                'deleted_at',
            ]);
        });
    }
};
