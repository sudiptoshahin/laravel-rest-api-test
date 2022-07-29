<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Post::class;
    
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'text' => $this->faker->sentence(30),
            'user_id' => User::factory(),
        ];
    }
}
