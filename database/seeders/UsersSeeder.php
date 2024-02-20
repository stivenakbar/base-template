<?php

namespace Database\Seeders;

use App\Models\RolesModel;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = [
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password')
        ];
        $user = [
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password')
        ];

        $admin = User::create($admin);
        $admin->assignRole('admin');
        $user = User::create($user);
        $user->assignRole('user');
    }
}
