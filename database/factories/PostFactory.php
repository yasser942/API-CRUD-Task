<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;

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
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(2),
            'content' => $this->faker->paragraph(5),
            'published' => $this->faker->boolean(50),
            'user_id' => User::factory(),
        ];
    }
    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterMaking(function (Post $post) {
            Log::info('after making' . $post->title);
        })->afterCreating(function (Post $post) {
            Log::info('after creating' . $post->title);
        });
    }



}
