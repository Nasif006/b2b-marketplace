<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();

        if (!$adminRole) {
            $this->command->warn('Admin role not found. Run RoleSeeder first.');
            return;
        }

        User::firstOrCreate(
            ['email' => 'admin@b2b.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('admin123'),
                'role_id'  => $adminRole->id,
            ]
        );

        $this->command->info('Admin user ready: admin@b2b.com / admin123');
    }
}
