<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;
use App\Models\User;

class CommentFactory extends Factory
{
    public function definition(): array
    {
        $article = Article::inRandomOrder()->first();

        return [
            'article_id' => $article?->id ?? Article::factory(),
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'body' => $this->faker->sentences(rand(1,3), true),
            'created_at' => now()->subDays(rand(0, 7))->subMinutes(rand(0, 300)),
            'updated_at' => now(),
        ];
    }
}