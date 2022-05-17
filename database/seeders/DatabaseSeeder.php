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

       
        // Roles
        DB::table('roles')->insert([
            'name' => 'admin', 
        ]);
        DB::table('roles')->insert([
            'name' => 'client',
        ]);

        // User Admin
        \App\Models\User::factory(1)->create();

        // Comprobar los seeders para ver si se puede usar RoleSeeder, si hay tiempo.

        // DATOS DE PRUEBA
        $sqlUsers = public_path('users.sql');
        $sqlExercises = public_path('training_exercises.sql');
        $sqlUsersContent = file_get_contents($sqlUsers);
        $sqlExercisesContent = file_get_contents($sqlExercises);

        DB::unprepared($sqlUsersContent);
        DB::unprepared($sqlExercisesContent);
    }
}
