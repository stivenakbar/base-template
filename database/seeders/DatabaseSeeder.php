<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
       
            $this->call([
                MenusSeeder::class,
                RolesSeeder::class,
                UsersSeeder::class,
                PermissionsSeeder::class,
                AccesSeeder::class,
                IconSeeder::class,
            ]);
        
        
    }
}