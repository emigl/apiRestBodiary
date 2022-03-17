<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin', 
        ]);
        DB::table('roles')->insert([
            'name' => 'client',
        ]);
        \App\Models\User::factory(1)->create();
        // Comprobar los seeders para ver si se puede usar RoleSeeder, si hay tiempo.
    }
}
