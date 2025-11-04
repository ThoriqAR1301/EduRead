@extends('layouts.app')

@section('title', 'Beranda - EduRead')

@section('content')
<style>
  :root {
    --primary-color: #1a4d7a;
    --accent-color: #d4a574;
    --background-color: #faf8f3;
    --text-dark: #2d3142;
    --text-light: #6b7280;
    --card-bg: #ffffff;
    --shadow-sm: 0 4px 6px rgba(26, 77, 122, 0.1);
    --shadow-md: 0 10px 25px rgba(26, 77, 122, 0.15);
  }

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: var(--background-color);
    color: var(--text-dark);
    overflow-x: hidden;
  }

  /* <CHANGE> Animated library background with floating books and shelves */
  .library-background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #faf8f3 0%, #f5f1e8 50%, #ede8dd 100%);
    z-index: 0;
    overflow: hidden;
  }

  .floating-book {
    position: absolute;
    opacity: 0.08;
    transform: rotate(-15deg);
    animation: float 20s infinite ease-in-out;
  }

  .floating-book:nth-child(1) {
    width: 60px;
    height: 90px;
    background: linear-gradient(45deg, #1a4d7a, #2d6a96);
    top: 10%;
    left: 5%;
    animation-delay: 0s;
  }

  .floating-book:nth-child(2) {
    width: 50px;
    height: 80px;
    background: linear-gradient(45deg, #d4a574, #c9934d);
    top: 30%;
    right: 8%;
    animation-delay: 3s;
    transform: rotate(20deg);
  }

  .floating-book:nth-child(3) {
    width: 70px;
    height: 100px;
    background: linear-gradient(45deg, #1a4d7a, #2d6a96);
    bottom: 15%;
    left: 10%;
    animation-delay: 6s;
    transform: rotate(-25deg);
  }

  .floating-book:nth-child(4) {
    width: 55px;
    height: 85px;
    background: linear-gradient(45deg, #d4a574, #c9934d);
    bottom: 20%;
    right: 5%;
    animation-delay: 9s;
    transform: rotate(15deg);
  }

  .floating-book:nth-child(5) {
    width: 65px;
    height: 95px;
    background: linear-gradient(45deg, #1a4d7a, #2d6a96);
    top: 50%;
    right: 15%;
    animation-delay: 12s;
    transform: rotate(-10deg);
  }

  @keyframes float {
    0%, 100% {
      transform: translateY(0) translateX(0) rotate(var(--rotation, -15deg));
    }
    50% {
      transform: translateY(-20px) translateX(10px) rotate(var(--rotation, -15deg));
    }
  }

  .shelf-line {
    position: absolute;
    background: linear-gradient(90deg, transparent, rgba(212, 165, 116, 0.2), transparent);
    height: 2px;
    animation: shimmer 8s infinite;
  }

  .shelf-line:nth-child(6) {
    width: 100%;
    top: 25%;
    animation-delay: 0s;
  }

  .shelf-line:nth-child(7) {
    width: 100%;
    top: 50%;
    animation-delay: 2s;
  }

  .shelf-line:nth-child(8) {
    width: 100%;
    bottom: 30%;
    animation-delay: 4s;
  }

  @keyframes shimmer {
    0%, 100% {
      opacity: 0.3;
    }
    50% {
      opacity: 0.8;
    }
  }

  /* <CHANGE> Main content wrapper */
  .content-wrapper {
    position: relative;
    z-index: 1;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }

  /* Header Section */
  header {
    background: rgba(26, 77, 122, 0.95);
    backdrop-filter: blur(10px);
    padding: 20px 0;
    box-shadow: var(--shadow-md);
    position: relative;
    z-index: 2;
  }

  .header-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .logo {
    font-size: 28px;
    font-weight: 700;
    color: var(--accent-color);
    text-decoration: none;
    letter-spacing: -0.5px;
  }

  .nav-links {
    display: flex;
    gap: 40px;
    list-style: none;
  }

  .nav-links a {
    color: #ffffff;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
  }

  .nav-links a:hover {
    color: var(--accent-color);
  }

  .create-btn {
    background: linear-gradient(135deg, var(--accent-color), #c9934d);
    color: var(--primary-color);
    padding: 10px 25px;
    border-radius: 50px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    text-decoration: none;
    display: inline-block;
  }

  .create-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(212, 165, 116, 0.4);
  }

  /* Hero Section */
  .hero {
    position: relative;
    padding: 100px 20px;
    margin: 0 auto;
    overflow: hidden;
    background: linear-gradient(135deg, #1a4d7a 0%, #15406a 100%);
    color: white;
  }

  .hero-content {
    max-width: 800px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
    text-align: center;
  }

  .animated-text {
    font-size: 4rem;
    font-weight: 800;
    background: linear-gradient(45deg, #ffffff, #d4a574);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 1.5rem;
    line-height: 1.2;
    animation: gradientMove 8s ease infinite;
  }

  @keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }

  .hero-subtitle {
    font-size: 1.25rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 2.5rem;
    line-height: 1.6;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
  }

  .hero-stats {
    display: flex;
    justify-content: center;
    gap: 2rem;
    align-items: center;
    margin-top: 3rem;
  }

  .stat-item {
    background: rgba(255, 255, 255, 0.1);
    padding: 1rem 2rem;
    border-radius: 1rem;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
  }

  .stat-number {
    display: block;
    font-size: 2.5rem;
    font-weight: 700;
    color: #d4a574;
    margin-bottom: 0.5rem;
  }

  .stat-label {
    font-size: 0.875rem;
    color: rgba(255, 255, 255, 0.8);
    text-transform: uppercase;
    letter-spacing: 1px;
  }

  .hero-cta {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    background: #d4a574;
    color: #1a4d7a;
    padding: 1rem 2rem;
    border-radius: 1rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
  }

  .hero-cta:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
  }

  .cta-icon {
    font-size: 1.5rem;
  }

  .hero-decoration {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: 1;
  }

  .floating-shape {
    position: absolute;
    background: rgba(255, 255, 255, 0.03);
    border-radius: 50%;
  }

  .shape1 {
    width: 300px;
    height: 300px;
    top: -100px;
    left: -100px;
    animation: float 20s infinite;
  }

  .shape2 {
    width: 200px;
    height: 200px;
    top: 50%;
    right: -50px;
    animation: float 15s infinite;
  }

  .shape3 {
    width: 150px;
    height: 150px;
    bottom: -50px;
    left: 50%;
    animation: float 18s infinite;
  }

  @keyframes float {
    0%, 100% {
      transform: translate(0, 0) rotate(0deg);
    }
    25% {
      transform: translate(50px, -30px) rotate(90deg);
    }
    50% {
      transform: translate(0, 50px) rotate(180deg);
    }
    75% {
      transform: translate(-50px, -30px) rotate(270deg);
    }
  }

  /* Articles Grid */
  .articles-section {
    max-width: 1200px;
    margin: 0 auto;
    padding: 60px 20px;
    width: 100%;
    flex: 1;
  }

  .section-title {
    font-size: 32px;
    margin-bottom: 40px;
    color: var(--primary-color);
    font-weight: 700;
    text-align: center;
  }

  .articles-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 30px;
    margin-bottom: 60px;
  }

  /* <CHANGE> Article card with hover effects and glass morphism */
  .article-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    position: relative;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
  }

  .article-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
  }

  .card-decoration {
    position: relative;
    height: 120px;
    background: linear-gradient(135deg, #1a4d7a 0%, #15406a 100%);
    overflow: hidden;
  }

  .card-icon {
    position: absolute;
    bottom: -30px;
    left: 20px;
    width: 60px;
    height: 60px;
    background: #d4a574;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    transform: rotate(-10deg);
    transition: transform 0.3s ease;
  }

  .article-card:hover .card-icon {
    transform: rotate(0deg) scale(1.1);
  }

  .card-content {
    padding: 40px 25px 25px;
  }

  .article-title {
    margin-bottom: 15px;
  }

  .title-link {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a4d7a;
    text-decoration: none;
    line-height: 1.4;
    transition: color 0.3s ease;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .title-link:hover {
    color: #d4a574;
  }

  .article-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }

  .meta-author {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .author-avatar {
    width: 35px;
    height: 35px;
    background: #1a4d7a;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
  }

  .author-name {
    font-size: 0.9rem;
    color: #1a4d7a;
    font-weight: 600;
  }

  .meta-date {
    font-size: 0.85rem;
    color: #666;
  }

  .article-excerpt {
    color: #666;
    line-height: 1.6;
    margin-bottom: 25px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #eee;
    padding-top: 20px;
  }

  .read-more {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #1a4d7a;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
  }

  .arrow-icon {
    width: 20px;
    height: 20px;
    fill: currentColor;
    transition: transform 0.3s ease;
  }

  .read-more:hover {
    color: #d4a574;
  }

  .read-more:hover .arrow-icon {
    transform: translateX(5px);
  }

  .article-stats {
    display: flex;
    gap: 15px;
  }

  .stat {
    display: flex;
    align-items: center;
    gap: 5px;
    color: #666;
    font-size: 0.85rem;
  }

  .stat-icon {
    width: 16px;
    height: 16px;
    fill: currentColor;
  }

  .stat-value {
    font-weight: 600;
  }

  /* Pagination */
  .pagination {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 50px;
    flex-wrap: wrap;
  }

  .pagination a,
  .pagination span {
    padding: 10px 16px;
    border-radius: 8px;
    border: 1px solid rgba(26, 77, 122, 0.2);
    background: rgba(255, 255, 255, 0.8);
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
  }

  .pagination a:hover {
    background: linear-gradient(135deg, var(--accent-color), #c9934d);
    color: var(--primary-color);
    border-color: var(--accent-color);
  }

  .pagination .active {
    background: linear-gradient(135deg, var(--primary-color), #2d6a96);
    color: white;
    border-color: var(--primary-color);
  }

  /* Footer */
  footer {
    background: rgba(26, 77, 122, 0.95);
    color: #ffffff;
    text-align: center;
    padding: 30px 20px;
    margin-top: 80px;
    font-size: 14px;
  }

  /* Responsive Design */
  @media (max-width: 1200px) {
    .articles-grid {
      grid-template-columns: repeat(2, 1fr);
      gap: 30px;
      padding: 0 20px;
    }
  }

  @media (max-width: 768px) {
    .animated-text {
      font-size: 3rem;
    }

    .hero-subtitle {
      font-size: 1.1rem;
    }

    .hero-stats {
      flex-direction: column;
      gap: 1.5rem;
    }

    .stat-item {
      width: 100%;
      max-width: 300px;
    }

    .articles-grid {
      grid-template-columns: 1fr;
      gap: 25px;
    }

    .card-decoration {
      height: 100px;
    }

    .card-icon {
      width: 50px;
      height: 50px;
      font-size: 1.5rem;
    }

    .card-content {
      padding: 30px 20px 20px;
    }

    .title-link {
      font-size: 1.25rem;
    }

    .article-meta {
      flex-direction: column;
      align-items: flex-start;
      gap: 10px;
    }

    .card-footer {
      flex-direction: column;
      gap: 15px;
    }

    .read-more {
      width: 100%;
      justify-content: center;
      padding: 10px;
      background: #f8f9fa;
      border-radius: 8px;
    }

    .article-stats {
      width: 100%;
      justify-content: center;
    }
  }

  @media (max-width: 480px) {
    .animated-text {
      font-size: 2.5rem;
    }

    .hero-subtitle {
      font-size: 1rem;
    }

    .stat-number {
      font-size: 2rem;
    }

    .hero-cta {
      width: 100%;
      justify-content: center;
    }

    .section-title {
      font-size: 1.75rem;
      padding: 0 20px;
    }

    .card-decoration {
      height: 80px;
    }

    .card-icon {
      width: 40px;
      height: 40px;
      font-size: 1.25rem;
    }
  }

  /* Animation Keyframes */
  @keyframes slideIn {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
    }
    to {
      opacity: 1;
    }
  }

  @keyframes scaleIn {
    from {
      transform: scale(0.9);
      opacity: 0;
    }
    to {
      transform: scale(1);
      opacity: 1;
    }
  }

  /* Utility Classes */
  .fade-in {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.6s ease, transform 0.6s ease;
  }

  .fade-in.appear {
    opacity: 1;
    transform: translateY(0);
  }

  .delay-1 { transition-delay: 0.1s; }
  .delay-2 { transition-delay: 0.2s; }
  .delay-3 { transition-delay: 0.3s; }
</style>

<div class="library-background">
  <div class="floating-book"></div>
  <div class="floating-book"></div>
  <div class="floating-book"></div>
  <div class="floating-book"></div>
  <div class="floating-book"></div>
  <div class="shelf-line"></div>
  <div class="shelf-line"></div>
  <div class="shelf-line"></div>
</div>

<div class="content-wrapper">
  <section class="hero fade-in">
    <div class="hero-content">
      <h1 class="animated-text">Jelajahi Pengetahuan</h1>
      <p class="hero-subtitle">Temukan dan baca artikel berkualitas tinggi yang dibagikan oleh komunitas EduRead</p>
      <div class="hero-stats">
        <div class="stat-item">
          <span class="stat-number">{{ $articles->total() }}</span>
          <span class="stat-label">Artikel Tersedia</span>
        </div>
        @auth
        <a href="{{ route('articles.create') }}" class="hero-cta">
          <span class="cta-icon">✍️</span>
          <span class="cta-text">Mulai Menulis</span>
        </a>
        @else
        <a href="{{ route('register') }}" class="hero-cta">
          <span class="cta-icon">👋</span>
          <span class="cta-text">Bergabung Sekarang</span>
        </a>
        @endauth
      </div>
    </div>
    <div class="hero-decoration">
      <div class="floating-shape shape1"></div>
      <div class="floating-shape shape2"></div>
      <div class="floating-shape shape3"></div>
    </div>
  </section>

  <section class="articles-section" id="articles">
    <h2 class="section-title fade-in">Artikel Terbaru</h2>
    
    @if($articles->count() > 0)
      <div class="articles-grid">
        @foreach($articles as $article)
          <article class="article-card fade-in">
            <div class="card-decoration">
              <div class="card-icon">📚</div>
            </div>
            <div class="card-content">
              <h3 class="article-title">
                <a href="{{ route('articles.show', $article) }}" class="title-link">
                  {{ $article->title }}
                </a>
              </h3>
              <div class="article-meta">
                <div class="meta-author">
                  <span class="author-avatar">
                    {{ strtoupper(substr($article->author->name ?? 'A', 0, 1)) }}
                  </span>
                  <span class="author-name">{{ $article->author->name ?? 'Anonim' }}</span>
                </div>
                <span class="meta-date">{{ $article->created_at->diffForHumans() }}</span>
              </div>
              <p class="article-excerpt">
                {{ \Illuminate\Support\Str::limit(strip_tags($article->body), 140) }}
              </p>
              <div class="card-footer">
                <a href="{{ route('articles.show', $article) }}" class="read-more">
                  <span>Baca Selengkapnya</span>
                  <svg class="arrow-icon" viewBox="0 0 24 24">
                    <path d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z"/>
                  </svg>
                </a>
                <div class="article-stats">
                  <span class="stat">
                    <svg class="stat-icon" viewBox="0 0 24 24">
                      <path d="M15 12c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3zm9-.449s-4.252 8.449-11.985 8.449c-7.18 0-12.015-8.449-12.015-8.449s4.446-7.551 12.015-7.551c7.694 0 11.985 7.551 11.985 7.551zm-7 .449c0-2.757-2.243-5-5-5s-5 2.243-5 5 2.243 5 5 5 5-2.243 5-5z"/>
                    </svg>
                    <span class="stat-value">{{ rand(10, 100) }}</span>
                  </span>
                  <span class="stat">
                    <svg class="stat-icon" viewBox="0 0 24 24">
                      <path d="M12 1c-6.338 0-12 4.226-12 10.007 0 2.05.739 4.063 2.047 5.625l-1.993 6.368 6.946-3.229c1.705.439 3.334.641 4.864.641 7.174 0 12.136-4.439 12.136-9.405 0-5.781-5.662-10.007-12-10.007z"/>
                    </svg>
                    <span class="stat-value">{{ $article->comments->count() }}</span>
                  </span>
                </div>
              </div>
            </div>
          </article>
        @endforeach
      </div>

      <div class="pagination">
        {{ $articles->links() }}
      </div>
    @else
      <div style="text-align: center; padding: 60px 20px;">
        <p style="font-size: 18px; color: var(--text-light);">Belum ada artikel tersedia. Jadilah yang pertama!</p>
        <a href="{{ route('articles.create') }}" class="create-btn" style="margin-top: 30px;">
          + Buat Artikel Pertama
        </a>
      </div>
    @endif
  </section>

  <footer>
    <p>&copy; 2025 EduRead - Platform Berbagi Pengetahuan. Semua hak cipta dilindungi.</p>
  </footer>
</div>
@endsection