<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::create([
            'name' => 'SuperAdmin DashUI',
            'email' => 'superadmin@dashui.dev',
            'password'  => Hash::make('password'),
            'is_active' => '1',
            'created_at' => now(),
            'updated_at' => now()

        ]);

        $admin = User::create([
            'name' => 'Admin DashUI',
            'email' => 'admin@dashui.dev',
            'password'  => Hash::make('password'),
            'is_active' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $manager = User::create([
            'name' => 'Manager DashUI',
            'email' => 'manager@dashui.dev',
            'password'  => Hash::make('password'),
            'is_active' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $user = User::create([
            'name' => 'Mutant',
            'email' => 'mutant@dashui.dev',
            'password'  => Hash::make('password'),
            'is_active' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $superAdmin->assignRole('SuperAdmin');
        $admin->assignRole('Admin');
        $manager->assignRole('Manager');
        $user->assignRole('User');
    }
}
