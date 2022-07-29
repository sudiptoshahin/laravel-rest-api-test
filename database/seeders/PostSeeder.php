<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory()
            ->count(100)
            ->hasComments(10)
            ->create();

        Post::factory()
            ->count(30)
            ->hasComments(10)
            ->create();

        // Post::factory()->count(1000)->create();
    }
}
