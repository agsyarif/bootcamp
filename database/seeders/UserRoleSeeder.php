<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'Admin', 'guard_name' => 'web'],
            ['name' => 'Mentor', 'guard_name' => 'web'],
            ['name' => 'Member', 'guard_name' => 'web'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate($role);
        }

        $admin = Role::where('name', 'Admin')->first();
        $admin->syncPermissions([
            'dashboard',
            'mentor-management',
            'member-management',
            'transaction',
            'course',
            'permission',
            'role-management',
            'log-activity',
            'progress'
        ]);

        $mentor = Role::where('name', 'Mentor')->first();
        $mentor->syncPermissions([
            'dashboard',
            'member-management',
            'transaction',
            'course',
            'progress'
        ]);

        $member = Role::where('name', 'Member')->first();
        $member->syncPermissions([
            'dashboard',
            'course',
            'progress'
        ]);
    }
}
