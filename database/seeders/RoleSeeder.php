<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Seed the roles table.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Super Admin',
                'slug' => 'super_admin',
                'description' => 'Administrador con acceso completo al sistema.',
            ],
            [
                'name' => 'Empresa',
                'slug' => 'empresa',
                'description' => 'Cuenta de empresa para publicar y gestionar vacantes.',
            ],
            [
                'name' => 'Candidato',
                'slug' => 'candidato',
                'description' => 'Cuenta de candidato para buscar empleo y postularse.',
            ],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['slug' => $role['slug']],
                [
                    'name' => $role['name'],
                    'description' => $role['description'],
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
