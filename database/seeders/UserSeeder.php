<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create basic roles
        $roles = [
            'System Admin',
            'Module Chair',
            'Timetable Manager',
            'Lecturer',
            'Student Representative',
            'Viewer',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }

        // Create a System Admin user
        $admin = User::firstOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'System Administrator',
                'email' => 'admin@mts.local',
                'password' => Hash::make('password123'),
                'is_active' => true,
            ]
        );

        $admin->assignRole('System Admin');
    }
}