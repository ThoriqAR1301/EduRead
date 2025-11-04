@extends('layouts.app')

@section('title','Edit Artikel - EduRead')

@section('content')
@if($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #faf8f3 0%, #f5f1e8 100%);
        min-height: 100vh;
    }

    /* Animated Background */
    .edit-page-container {
        position: relative;
        min-height: 100vh;
        width: 100%;
        overflow: hidden;
    }

    .bg-animated {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 0;
    }

    .floating-book {
        position: absolute;
        opacity: 0.08;
        animation: float 8s ease-in-out infinite;
    }

    .book-1 {
        width: 60px;
        height: 80px;
        background: #1a4d7a;
        top: 10%;
        left: 5%;
        animation-delay: 0s;
    }

    .book-2 {
        width: 50px;
        height: 70px;
        background: #d4a574;
        top: 30%;
        right: 8%;
        animation-delay: 1.5s;
    }

    .book-3 {
        width: 55px;
        height: 75px;
        background: #1a4d7a;
        bottom: 20%;
        left: 10%;
        animation-delay: 1s;
    }

    .book-4 {
        width: 45px;
        height: 65px;
        background: #d4a574;
        bottom: 30%;
        right: 15%;
        animation-delay: 2s;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
        }
        50% {
            transform: translateY(-20px) rotate(5deg);
        }
    }

    /* Content */
    .content-wrapper {
        position: relative;
        z-index: 1;
        max-width: 800px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .edit-form {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 8px 32px rgba(26, 77, 122, 0.1);
        border: 1px solid rgba(212, 165, 116, 0.2);
    }

    .form-header {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid rgba(26, 77, 122, 0.1);
    }

    .form-header h1 {
        font-size: 28px;
        color: #1a4d7a;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .form-header p {
        color: #666;
        font-size: 16px;
    }

    /* Form Elements */
    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #1a4d7a;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e0d5c7;
        border-radius: 8px;
        font-size: 16px;
        color: #2d3142;
        background: #fefdfb;
        transition: all 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: #d4a574;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(212, 165, 116, 0.1);
    }

    textarea.form-input {
        min-height: 300px;
        resize: vertical;
    }

    /* Error Messages */
    .error-container {
        background: #fef2f2;
        border: 1px solid #fed7d7;
        border-radius: 8px;
        padding: 16px 20px;
        margin-bottom: 25px;
        border-left: 4px solid #dc2626;
    }

    .error-list {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .error-item {
        color: #dc2626;
        font-size: 14px;
        margin-bottom: 4px;
    }

    .error-item:last-child {
        margin-bottom: 0;
    }

    /* Buttons */
    .button-group {
        display: flex;
        gap: 12px;
        margin-top: 30px;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, #1a4d7a 0%, #2d6a9f 100%);
        color: white;
        flex: 1;
        box-shadow: 0 4px 15px rgba(26, 77, 122, 0.2);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(26, 77, 122, 0.3);
    }

    .btn-secondary {
        background: transparent;
        border: 2px solid #1a4d7a;
        color: #1a4d7a;
    }

    .btn-secondary:hover {
        background: rgba(26, 77, 122, 0.05);
    }

    /* Responsive */
    @media (max-width: 640px) {
        .edit-form {
            padding: 25px;
        }

        .form-header h1 {
            font-size: 24px;
        }

        .button-group {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }
    }
</style>

<div class="edit-page-container">
    <div class="bg-animated">
        <div class="floating-book book-1"></div>
        <div class="floating-book book-2"></div>
        <div class="floating-book book-3"></div>
        <div class="floating-book book-4"></div>
    </div>

    <div class="content-wrapper">
        <div class="edit-form">
            <div class="form-header">
                <h1>Edit Artikel</h1>
                <p>Perbarui dan tingkatkan konten artikel Anda</p>
            </div>

            @if ($errors->any())
            <div class="error-container">
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li class="error-item">• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('articles.update', $article) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Judul Artikel</label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        class="form-input" 
                        value="{{ old('title', $article->title) }}" 
                        placeholder="Masukkan judul artikel..."
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="body">Isi Artikel</label>
                    <textarea 
                        id="body" 
                        name="body" 
                        class="form-input" 
                        placeholder="Tulis isi artikel Anda di sini..."
                        required
                    >{{ old('body', $article->body) }}</textarea>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection