<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(6, true);
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'body' => fake()->paragraphs(5, true),
            'created_at' => now()->subDays(rand(0, 10)),
            'updated_at' => now(),
        ];
    }
}
