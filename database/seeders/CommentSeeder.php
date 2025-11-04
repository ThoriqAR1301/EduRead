<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Comment;
use App\Models\User;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create([
            'name' => 'Admin EduRead',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        if (Article::count() === 0) {
            Article::factory(8)->create();
        }

        Article::all()->each(function ($article) {
            $count = rand(1, 5);
            Comment::factory($count)->create([
                'article_id' => $article->id,
            ]);
        });
    }
}