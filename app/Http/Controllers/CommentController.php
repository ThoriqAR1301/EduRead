<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;
use Auth;

class CommentController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request, Article $article)
    {
        $request->validate(['body'=>'required|string|max:1000']);

        Comment::create([
            'article_id' => $article->id,
            'user_id' => Auth::id(),
            'body' => $request->body,
        ]);

        return back()->with('success','Komentar Terkirim');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
