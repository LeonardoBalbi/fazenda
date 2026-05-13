<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SyncFilamentRolesSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = Role::firstOrCreate(
            ['name' => 'super_admin', 'guard_name' => 'web']
        );
        $admin = Role::firstOrCreate(
            ['name' => 'admin', 'guard_name' => 'web']
        );

        $leonardo = User::updateOrCreate(
            ['email' => 'leonardocbalbi@gmail.com'],
            [
                'name' => 'Leonardo',
                'password' => Hash::make('123456789'),
            ]
        );
        $leonardo->syncRoles([$superAdmin]);

        $adminUser = User::updateOrCreate(
            ['email' => 'admin@passeios.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
            ]
        );
        $adminUser->syncRoles([$admin]);
    }
}
