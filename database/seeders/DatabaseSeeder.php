<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create users
        User::updateOrCreate(
            ['email' => 'leonardocbalb@gmail.com'],
            [
                'name'     => 'Leonardo',
                'password' => Hash::make('123456789'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@passeios.com'],
            [
                'name'     => 'Administrador',
                'password' => Hash::make('password'),
            ]
        );

        $this->call([
            OrganizadoresSeeder::class,
            TransportadorasSeeder::class,
            RolesAndPermissionsSeeder::class,
        ]);
    }
}
