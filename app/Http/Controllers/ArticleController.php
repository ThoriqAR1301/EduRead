<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ArticleController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $articles = Article::with('author')->latest()->paginate(6);
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $article = Article::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => Str::slug($request->title).'-'.Str::random(6),
            'body' => $request->body,
        ]);

        return redirect()->route('dashboard')->with('success','Artikel Berhasil Dibuat');
    }

    public function show(Article $article)
    {
        $article->load(['author','comments.user']);
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        $this->authorize('update', $article);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $this->authorize('update', $article);

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $article->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('dashboard')->with('success','Artikel Diperbarui');
    }

    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        $article->delete();
        return redirect()->route('dashboard')->with('success','Artikel Dihapus');
    }

    public function dashboard()
    {
        $articles = Auth::user()->articles()->latest()->get();
        return view('dashboard', compact('articles'));
    }
}