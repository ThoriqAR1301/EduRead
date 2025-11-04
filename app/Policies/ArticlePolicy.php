<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if (isset($user->is_admin) && $user->is_admin) {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Article $article)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Article $article)
    {
        return $user->id === $article->user_id;
    }

    public function delete(User $user, Article $article)
    {
        return $user->id === $article->user_id;
    }

    public function restore(User $user, Article $article)
    {
        return false;
    }

    public function forceDelete(User $user, Article $article)
    {
        return false;
    }
}