<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::factory()
        //     ->count(20)
        //     ->hasPosts(40)
        //     ->hasComments(60)
        //     ->create();

        // User::factory()
        //     ->count(100)
        //     ->hasPosts(10)
        //     ->hasComments(20)
        //     ->create();

        // User::factory()
        //     ->count(10)
        //     ->hasPosts(5)
        //     ->hasComments(3)
        //     ->create();

        User::factory()->count(500)->create();
    }
}
