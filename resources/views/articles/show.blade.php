@extends('layouts.app')

@section('title', $article->title)

@section('content')
<style>
    /* Library-themed animated background */
    body {
        background: linear-gradient(135deg, #faf8f3 0%, #f5f1e8 100%);
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }

    /* Animated background elements */
    .background-animation {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
        pointer-events: none;
    }

    .floating-book {
        position: absolute;
        opacity: 0.15;
        animation: float 6s ease-in-out infinite;
    }

    .floating-book:nth-child(1) {
        width: 60px;
        height: 80px;
        background: linear-gradient(135deg, #1a4d7a 0%, #0f3452 100%);
        top: 10%;
        left: 5%;
        animation-delay: 0s;
        border-radius: 3px;
    }

    .floating-book:nth-child(2) {
        width: 70px;
        height: 100px;
        background: linear-gradient(135deg, #d4a574 0%, #b8860b 100%);
        top: 20%;
        right: 8%;
        animation-delay: 1s;
        border-radius: 3px;
    }

    .floating-book:nth-child(3) {
        width: 50px;
        height: 70px;
        background: linear-gradient(135deg, #1a4d7a 0%, #0f3452 100%);
        bottom: 15%;
        left: 10%;
        animation-delay: 2s;
        border-radius: 3px;
    }

    .floating-book:nth-child(4) {
        width: 65px;
        height: 90px;
        background: linear-gradient(135deg, #d4a574 0%, #b8860b 100%);
        bottom: 20%;
        right: 5%;
        animation-delay: 1.5s;
        border-radius: 3px;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
        }
        50% {
            transform: translateY(-30px) rotate(5deg);
        }
    }

    /* Bookshelf lines */
    .bookshelf-line {
        position: absolute;
        background: linear-gradient(90deg, transparent, rgba(212, 165, 116, 0.3), transparent);
        opacity: 0.3;
        animation: shimmer 4s ease-in-out infinite;
    }

    .bookshelf-line:nth-child(5) {
        width: 100%;
        height: 2px;
        top: 25%;
        left: 0;
        animation-delay: 0s;
    }

    .bookshelf-line:nth-child(6) {
        width: 100%;
        height: 2px;
        bottom: 30%;
        left: 0;
        animation-delay: 2s;
    }

    @keyframes shimmer {
        0%, 100% {
            opacity: 0.1;
        }
        50% {
            opacity: 0.4;
        }
    }

    /* Main content wrapper */
    .content-wrapper {
        position: relative;
        z-index: 1;
        min-height: 100vh;
        padding: 2rem;
    }

    /* Article container */
    .article-container {
        max-width: 800px;
        margin: 0 auto;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        padding: 3rem;
        box-shadow: 0 8px 32px rgba(26, 77, 122, 0.1);
        border: 1px solid rgba(212, 165, 116, 0.2);
        animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Article title */
    .article-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1a4d7a;
        margin-bottom: 1rem;
        line-height: 1.3;
        letter-spacing: -0.5px;
    }

    /* Article metadata */
    .article-meta {
        display: flex;
        gap: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid rgba(212, 165, 116, 0.3);
        margin-bottom: 2rem;
        font-size: 0.95rem;
        color: #666;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .author-name {
        color: #1a4d7a;
        font-weight: 600;
    }

    .meta-separator {
        color: #d4a574;
        margin: 0 0.5rem;
    }

    /* Article body */
    .article-body {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #2d3142;
        margin-bottom: 3rem;
    }

    .article-body p {
        margin-bottom: 1.5rem;
    }

    /* Comments section */
    .comments-section {
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 2px solid rgba(212, 165, 116, 0.3);
    }

    .comments-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a4d7a;
        margin-bottom: 2rem;
    }

    /* Comment form */
    .comment-form {
        background: linear-gradient(135deg, rgba(26, 77, 122, 0.05), rgba(212, 165, 116, 0.05));
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border: 1px solid rgba(212, 165, 116, 0.2);
    }

    .comment-form textarea {
        width: 100%;
        padding: 1rem;
        border: 1px solid #d4a574;
        border-radius: 6px;
        font-size: 0.95rem;
        font-family: inherit;
        resize: vertical;
        min-height: 100px;
        background: white;
        color: #2d3142;
        transition: all 0.3s ease;
    }

    .comment-form textarea:focus {
        outline: none;
        border-color: #1a4d7a;
        box-shadow: 0 0 0 3px rgba(26, 77, 122, 0.1);
    }

    .comment-form textarea::placeholder {
        color: #999;
    }

    .comment-submit {
        background: linear-gradient(135deg, #1a4d7a 0%, #0f3452 100%);
        color: white;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        margin-top: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .comment-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(26, 77, 122, 0.3);
    }

    /* Login prompt */
    .login-prompt {
        background: linear-gradient(135deg, rgba(212, 165, 116, 0.1), rgba(26, 77, 122, 0.05));
        border-radius: 8px;
        padding: 1.5rem;
        border-left: 4px solid #d4a574;
        margin-bottom: 2rem;
    }

    .login-prompt p {
        color: #2d3142;
        margin: 0;
    }

    .login-prompt a {
        color: #1a4d7a;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .login-prompt a:hover {
        color: #d4a574;
    }

    /* Comments list */
    .comments-list {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .comment-item {
        background: rgba(255, 255, 255, 0.7);
        border-radius: 8px;
        padding: 1.5rem;
        border-left: 3px solid #d4a574;
        transition: all 0.3s ease;
    }

    .comment-item:hover {
        background: white;
        box-shadow: 0 4px 12px rgba(26, 77, 122, 0.1);
        transform: translateX(4px);
    }

    .comment-meta {
        font-size: 0.85rem;
        color: #999;
        margin-bottom: 0.75rem;
    }

    .comment-author {
        color: #1a4d7a;
        font-weight: 600;
    }

    .comment-body {
        color: #2d3142;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .no-comments {
        text-align: center;
        padding: 2rem;
        color: #999;
        font-style: italic;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .article-container {
            padding: 1.5rem;
        }

        .article-title {
            font-size: 1.75rem;
        }

        .article-meta {
            flex-direction: column;
            gap: 0.5rem;
        }

        .content-wrapper {
            padding: 1rem;
        }
    }
</style>

<div class="background-animation">
    <div class="floating-book"></div>
    <div class="floating-book"></div>
    <div class="floating-book"></div>
    <div class="floating-book"></div>
    <div class="bookshelf-line"></div>
    <div class="bookshelf-line"></div>
</div>

<div class="content-wrapper">
    <article class="article-container">
        <!-- Article Header -->
        <h1 class="article-title">{{ $article->title }}</h1>

        <!-- Article Metadata -->
        <div class="article-meta">
            <div class="meta-item">
                <span class="author-name">{{ $article->author->name ?? 'Penulis Anonim' }}</span>
            </div>
            <div class="meta-item">
                <span class="meta-separator">•</span>
                <span>{{ $article->created_at->format('d M Y') }}</span>
            </div>
            <div class="meta-item">
                <span class="meta-separator">•</span>
                <span>Dipublikasikan {{ $article->created_at->diffForHumans() }}</span>
            </div>
        </div>

        <!-- Article Body -->
        <div class="article-body">
            {!! nl2br(e($article->body)) !!}
        </div>

        <!-- Comments Section -->
        <section class="comments-section">
            <h3 class="comments-title">Komentar ({{ $article->comments->count() }})</h3>

            @auth
                <!-- Comment Form for Authenticated Users -->
                <form action="{{ route('articles.comments.store', $article) }}" method="POST" class="comment-form">
                    @csrf
                    <textarea name="body" placeholder="Tulis komentar Anda... Bagikan pemikiran dan perspektif Anda tentang artikel ini."></textarea>
                    <button type="submit" class="comment-submit">Kirim Komentar</button>
                </form>
            @else
                <!-- Login Prompt for Unauthenticated Users -->
                <div class="login-prompt">
                    <p>Silakan <a href="{{ route('login') }}">login</a> atau <a href="{{ route('register') }}">daftar</a> untuk memberikan komentar.</p>
                </div>
            @endauth

            <!-- Comments List -->
            <div class="comments-list">
                @forelse($article->comments as $comment)
                    <div class="comment-item">
                        <div class="comment-meta">
                            <span class="comment-author">{{ $comment->user->name ?? 'Pengguna Anonim' }}</span>
                            <span class="meta-separator">•</span>
                            <span>{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="comment-body">{{ $comment->body }}</p>
                    </div>
                @empty
                    <div class="no-comments">
                        <p>Belum ada komentar. Jadilah yang pertama untuk memberikan komentar!</p>
                    </div>
                @endforelse
            </div>
        </section>
    </article>
</div>
@endsection