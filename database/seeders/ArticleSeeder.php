<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create([
            'name' => 'Admin EduRead',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        Article::factory(10)->create();
    }
}