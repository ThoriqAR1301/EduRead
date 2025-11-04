@extends('layouts.app')

@section('title','Dashboard - EduRead')

@section('content')
<style>
  /* <CHANGE> Added animated library background styles */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  html, body {
    height: 100%;
    width: 100%;
    overflow-x: hidden;
  }

  body {
    background: linear-gradient(135deg, #faf8f3 0%, #f5f1e8 100%);
  }

  .dashboard-container {
    position: relative;
    min-height: 100vh;
    width: 100%;
    overflow: hidden;
  }

  /* Animated background layers */
  .bg-animated {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 0;
  }

  .bookshelf-line {
    position: absolute;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, #d4a574, transparent);
    opacity: 0.3;
  }

  .bookshelf-1 {
    top: 15%;
    animation: slideShelf 30s linear infinite;
  }

  .bookshelf-2 {
    top: 35%;
    animation: slideShelfReverse 35s linear infinite;
  }

  .bookshelf-3 {
    top: 55%;
    animation: slideShelf 32s linear infinite;
  }

  .bookshelf-4 {
    bottom: 20%;
    animation: slideShelfReverse 28s linear infinite;
  }

  @keyframes slideShelf {
    from { transform: translateX(-100%); }
    to { transform: translateX(100%); }
  }

  @keyframes slideShelfReverse {
    from { transform: translateX(100%); }
    to { transform: translateX(-100%); }
  }

  /* Floating books */
  .floating-books {
    position: absolute;
    width: 100%;
    height: 100%;
  }

  .book {
    position: absolute;
    opacity: 0.08;
  }

  .book-1 {
    width: 60px;
    height: 80px;
    background: #1a4d7a;
    top: 10%;
    left: 5%;
    animation: float 8s ease-in-out infinite;
    transform: rotate(-15deg);
  }

  .book-2 {
    width: 50px;
    height: 70px;
    background: #d4a574;
    top: 25%;
    right: 10%;
    animation: float 10s ease-in-out infinite 1s;
    transform: rotate(20deg);
  }

  .book-3 {
    width: 55px;
    height: 75px;
    background: #1a4d7a;
    top: 50%;
    left: 15%;
    animation: float 9s ease-in-out infinite 0.5s;
    transform: rotate(-10deg);
  }

  .book-4 {
    width: 65px;
    height: 85px;
    background: #d4a574;
    bottom: 15%;
    right: 8%;
    animation: float 11s ease-in-out infinite 1.5s;
    transform: rotate(15deg);
  }

  .book-5 {
    width: 58px;
    height: 78px;
    background: #1a4d7a;
    bottom: 30%;
    left: 10%;
    animation: float 8.5s ease-in-out infinite 0.8s;
    transform: rotate(-20deg);
  }

  @keyframes float {
    0%, 100% { transform: translateY(0px) rotate(var(--rotation)); }
    50% { transform: translateY(-30px) rotate(var(--rotation)); }
  }

  /* Content overlay */
  .dashboard-content {
    position: relative;
    z-index: 10;
    padding: 40px 20px;
    min-height: 100vh;
  }

  .content-wrapper {
    max-width: 1200px;
    margin: 0 auto;
  }

  /* Header section */
  .dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    gap: 20px;
  }

  .dashboard-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a4d7a;
    letter-spacing: -0.5px;
  }

  .create-btn {
    padding: 12px 28px;
    background: linear-gradient(135deg, #1a4d7a 0%, #2d6a9f 100%);
    color: #faf8f3;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(26, 77, 122, 0.2);
  }

  .create-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(26, 77, 122, 0.3);
    background: linear-gradient(135deg, #2d6a9f 0%, #1a4d7a 100%);
  }

  /* Alert styles */
  .alert {
    padding: 16px 20px;
    border-radius: 8px;
    margin-bottom: 24px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(212, 165, 116, 0.3);
  }

  .alert-success {
    background: rgba(26, 77, 122, 0.1);
    color: #1a4d7a;
    border-color: rgba(26, 77, 122, 0.2);
  }

  /* Empty state */
  .empty-state {
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(10px);
    padding: 60px 40px;
    border-radius: 12px;
    text-align: center;
    border: 1px solid rgba(212, 165, 116, 0.2);
  }

  .empty-state p {
    color: #2d3142;
    font-size: 1.1rem;
    line-height: 1.6;
  }

  /* Table container */
  .table-wrapper {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 32px rgba(26, 77, 122, 0.1);
    border: 1px solid rgba(212, 165, 116, 0.15);
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  thead {
    background: linear-gradient(135deg, #1a4d7a 0%, #2d6a9f 100%);
  }

  thead th {
    padding: 18px 20px;
    text-align: left;
    color: #faf8f3;
    font-weight: 600;
    font-size: 0.95rem;
    letter-spacing: 0.3px;
  }

  tbody tr {
    border-bottom: 1px solid rgba(26, 77, 122, 0.05);
    transition: all 0.3s ease;
  }

  tbody tr:hover {
    background: rgba(26, 77, 122, 0.03);
  }

  tbody td {
    padding: 16px 20px;
    color: #2d3142;
  }

  .article-title {
    font-weight: 600;
    color: #1a4d7a;
    text-decoration: none;
    transition: color 0.2s ease;
  }

  .article-title:hover {
    color: #d4a574;
  }

  .article-author {
    font-size: 0.85rem;
    color: #7a8a99;
    margin-top: 4px;
  }

  .article-date {
    color: #7a8a99;
    font-size: 0.95rem;
  }

  .status-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 600;
  }

  .status-new {
    background: rgba(26, 77, 122, 0.15);
    color: #1a4d7a;
  }

  .status-updated {
    background: rgba(212, 165, 116, 0.15);
    color: #8b7355;
  }

  .action-buttons {
    display: flex;
    gap: 8px;
  }

  .btn-edit, .btn-delete {
    padding: 6px 12px;
    border-radius: 6px;
    border: 1px solid;
    font-size: 0.85rem;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s ease;
  }

  .btn-edit {
    border-color: #1a4d7a;
    color: #1a4d7a;
    background: transparent;
  }

  .btn-edit:hover {
    background: rgba(26, 77, 122, 0.1);
  }

  .btn-delete {
    border-color: #dc2626;
    color: #dc2626;
    background: transparent;
  }

  .btn-delete:hover {
    background: rgba(220, 38, 38, 0.1);
  }

  /* Pagination */
  .pagination-wrapper {
    margin-top: 24px;
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(10px);
    padding: 20px;
    border-radius: 8px;
    border: 1px solid rgba(212, 165, 116, 0.15);
  }

  /* Responsive */
  @media (max-width: 768px) {
    .dashboard-header {
      flex-direction: column;
      align-items: flex-start;
    }

    .dashboard-header h1 {
      font-size: 1.8rem;
    }

    table {
      font-size: 0.9rem;
    }

    thead th, tbody td {
      padding: 12px 10px;
    }

    .action-buttons {
      flex-direction: column;
    }

    .btn-edit, .btn-delete {
      width: 100%;
      text-align: center;
    }
  }
</style>

<!-- Animated background -->
<div class="bg-animated">
  <div class="floating-books">
    <div class="book book-1"></div>
    <div class="book book-2"></div>
    <div class="book book-3"></div>
    <div class="book book-4"></div>
    <div class="book book-5"></div>
  </div>
  <div class="bookshelf-line bookshelf-1"></div>
  <div class="bookshelf-line bookshelf-2"></div>
  <div class="bookshelf-line bookshelf-3"></div>
  <div class="bookshelf-line bookshelf-4"></div>
</div>

<!-- Main content -->
<div class="dashboard-container">
  <div class="dashboard-content">
    <div class="content-wrapper">
      <div class="dashboard-header">
        <h1>Dashboard Artikel</h1>
        <a href="{{ route('articles.create') }}" class="create-btn">
          <span>+</span>
          Buat Artikel
        </a>
      </div>

      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      @if($articles->isEmpty())
        <div class="empty-state">
          <p>Kamu belum membuat artikel apa pun. Klik tombol <strong>Buat Artikel</strong> untuk memulai perjalanan menulis kamu di EduRead.</p>
        </div>
      @else
        <div class="table-wrapper">
          <table>
            <thead>
              <tr>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th style="text-align: right;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($articles as $a)
                <tr>
                  <td>
                    <a href="{{ route('articles.show', $a) }}" class="article-title">{{ $a->title }}</a>
                    <div class="article-author">oleh {{ $a->author->name ?? 'Anda' }}</div>
                  </td>
                  <td class="article-date">{{ $a->created_at->format('d M Y') }}</td>
                  <td>
                    <span class="status-badge {{ $a->updated_at->gt($a->created_at) ? 'status-updated' : 'status-new' }}">
                      {{ $a->updated_at->gt($a->created_at) ? 'Diperbarui' : 'Baru' }}
                    </span>
                  </td>
                  <td style="text-align: right;">
                    <div class="action-buttons">
                      <a href="{{ route('articles.edit', $a) }}" class="btn-edit">Edit</a>
                      <form action="{{ route('articles.destroy', $a) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus artikel ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Hapus</button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        @if(method_exists($articles, 'links'))
          <div class="pagination-wrapper">
            {{ $articles->links() }}
          </div>
        @endif
      @endif
    </div>
  </div>
</div>
@endsection