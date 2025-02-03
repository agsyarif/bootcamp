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
        // $user1 = User::create([
        //     'name' => 'Admin',
        //     'email' => 'userAdmin@gmail.com',
        //     // 'user_role_id' => 1,
        //     'skill_id' => null,
        //     'contact_number' => null,
        //     'description' => null,
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('admin'),
        //     'two_factor_secret' => null,
        //     'two_factor_recovery_codes' => null,
        //     'remember_token' => 'Admin',
        //     'current_team_id' => null,
        //     'profile_photo_path' => null,
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
        // $user1->assignRole('Admin');

        // $user2 = User::create([
        //     'name' => 'Mentor',
        //     'email' => 'userMentor@gmail.com',
        //     // 'user_role_id' => 2,
        //     'skill_id' => null,
        //     'contact_number' => null,
        //     'description' => null,
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('mentor'),
        //     'two_factor_secret' => null,
        //     'two_factor_recovery_codes' => null,
        //     'remember_token' => 'Admin',
        //     'current_team_id' => null,
        //     'profile_photo_path' => null,
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);
        // $user2->assignRole('Mentor');

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
