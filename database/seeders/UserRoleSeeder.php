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
        DB::table('user_roles')->insert([
            ['name' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mentor', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Member', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tutor', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // DB::table('roles')->insert([
        //     ['name' => 'Admin', 'created_at' => now(), 'guard_name' => 'web', 'updated_at' => now()],
        //     ['name' => 'Mentor', 'created_at' => now(), 'guard_name' => 'web', 'updated_at' => now()],
        //     ['name' => 'Member', 'created_at' => now(), 'guard_name' => 'web', 'updated_at' => now()],
        // ]);

        $roles = [
            ['name' => 'Admin', 'guard_name' => 'web'],
            ['name' => 'Mentor', 'guard_name' => 'web'],
            ['name' => 'Member', 'guard_name' => 'web'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate($role);
        }
    }
}
