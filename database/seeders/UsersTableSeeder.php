<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Admin Roope',
                'email' => 'admin@roope.id',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ],
            [
                'name' => 'Customer Example',
                'email' => 'user@example.com',
                'password' => Hash::make('user123'),
                'role' => 'user'
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'password' => Hash::make('user123'),
                'role' => 'user'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        $this->command->info('✅ Users data created successfully!');
        $this->command->info('📧 Admin: admin@roope.id / admin123');
        $this->command->info('📧 User: user@example.com / user123');
    }
}
