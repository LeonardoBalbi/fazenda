<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SyncFilamentRolesSeeder::class,
            OrganizadoresSeeder::class,
            TransportadorasSeeder::class,
        ]);
    }
}
