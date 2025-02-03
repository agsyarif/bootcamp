<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::firstOrCreate([
            'email' => 'userAdmin@gmail.com'
        ], [
            'name' => 'Admin',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'remember_token' => 'Admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $admin->assignRole('Admin');
        $admin->syncPermissions(Permission::all());

        $mentor = User::firstOrCreate([
            'email' => 'userMentor@gmail.com'
        ], [
            'name' => 'Mentor',
            'email_verified_at' => now(),
            'password' => bcrypt('mentor'),
            'remember_token' => 'Mentor',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $mentor->assignRole('Mentor');
    }
}
