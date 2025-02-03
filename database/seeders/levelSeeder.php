<?php

namespace Database\Seeders;

use App\Models\level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class levelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $level = new \App\Models\level();
        // $level->name = 'Beginner';
        // $level->save();
        // $level = new \App\Models\level();
        // $level->name = 'Intermediate';
        // $level->save();
        // $level = new \App\Models\level();
        // $level->name = 'Advanced';
        // $level->save();

        $levels = ['Beginner', 'Intermediate', 'Advanced'];

        foreach ($levels as $level) {
            level::firstOrCreate(['name' => $level]);
        }

    }
}
