@extends('layouts.app')

@section('title','Buat Artikel - EduRead')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Artikel - EduRead</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            overflow: hidden;
        }

        .page-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f5f1e8 0%, #e8dcc8 50%, #ddc8a8 100%);
            position: relative;
            overflow: hidden;
        }

        /* Animated Background - Library Theme */
        .animated-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            opacity: 0.15;
        }

        /* Floating Books Animation */
        .book {
            position: absolute;
            width: 40px;
            height: 60px;
            border-radius: 2px;
            animation: float 8s ease-in-out infinite;
        }

        .book1 {
            background: linear-gradient(135deg, #1a4d7a, #2d7a9f);
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }

        .book2 {
            background: linear-gradient(135deg, #d4a574, #c49060);
            top: 20%;
            right: 8%;
            animation-delay: 2s;
            animation-duration: 10s;
        }

        .book3 {
            background: linear-gradient(135deg, #1a4d7a, #2d7a9f);
            bottom: 15%;
            left: 10%;
            animation-delay: 4s;
        }

        .book4 {
            background: linear-gradient(135deg, #8b5a2b, #a0672d);
            top: 50%;
            right: 5%;
            animation-delay: 1s;
            animation-duration: 12s;
        }

        .book5 {
            background: linear-gradient(135deg, #d4a574, #c49060);
            bottom: 20%;
            right: 15%;
            animation-delay: 3s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.1;
            }
            25% {
                transform: translateY(-30px) rotate(2deg);
                opacity: 0.3;
            }
            50% {
                transform: translateY(-60px) rotate(0deg);
                opacity: 0.2;
            }
            75% {
                transform: translateY(-30px) rotate(-2deg);
                opacity: 0.3;
            }
        }

        /* Library Shelf Lines */
        .shelf-line {
            position: absolute;
            background: linear-gradient(90deg, rgba(26, 77, 122, 0.3), transparent);
            height: 2px;
        }

        .shelf1 {
            width: 80%;
            top: 25%;
            left: 0;
            animation: shimmer 4s ease-in-out infinite;
        }

        .shelf2 {
            width: 90%;
            top: 60%;
            left: 0;
            animation: shimmer 5s ease-in-out infinite 1s;
        }

        @keyframes shimmer {
            0%, 100% {
                opacity: 0.1;
            }
            50% {
                opacity: 0.4;
            }
        }

        /* Main Content */
        .content-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 900px;
            padding: 40px;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(26, 77, 122, 0.2),
                        0 0 40px rgba(212, 165, 116, 0.15);
            padding: 50px;
            border: 1px solid rgba(212, 165, 116, 0.3);
        }

        .header-section {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 2px solid #1a4d7a;
            padding-bottom: 25px;
        }

        .header-section h1 {
            font-size: 2.5em;
            color: #1a4d7a;
            margin-bottom: 10px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .header-section p {
            color: #666;
            font-size: 1.1em;
            font-weight: 500;
        }

        /* Book Icon */
        .book-icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #1a4d7a, #2d7a9f);
            border-radius: 4px;
            margin-right: 12px;
            vertical-align: middle;
            position: relative;
        }

        .book-icon::before {
            content: '';
            position: absolute;
            width: 3px;
            height: 24px;
            background: #d4a574;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        /* Form Fields */
        .form-group {
            margin-bottom: 30px;
        }

        .form-group label {
            display: block;
            font-size: 1em;
            font-weight: 600;
            color: #1a4d7a;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e0d5c7;
            border-radius: 8px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 1em;
            transition: all 0.3s ease;
            background: #fefdfb;
            color: #333;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #d4a574;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(212, 165, 116, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 300px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-group textarea::placeholder,
        .form-group input::placeholder {
            color: #999;
        }

        /* Error Messages */
        .error-alert {
            margin-bottom: 30px;
            padding: 16px 20px;
            background: #fef2f2;
            border: 1px solid #fed7d7;
            border-radius: 8px;
            border-left: 4px solid #c53030;
        }

        .error-alert ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .error-alert li {
            color: #c53030;
            font-size: 0.95em;
            margin-bottom: 5px;
        }

        .error-alert li:last-child {
            margin-bottom: 0;
        }

        /* Button Group */
        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 40px;
            justify-content: center;
        }

        button[type="submit"],
        .btn-cancel {
            padding: 14px 40px;
            border-radius: 8px;
            font-size: 1em;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        button[type="submit"] {
            background: linear-gradient(135deg, #1a4d7a, #2d7a9f);
            color: white;
            box-shadow: 0 8px 20px rgba(26, 77, 122, 0.3);
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(26, 77, 122, 0.4);
        }

        button[type="submit"]:active {
            transform: translateY(0);
        }

        .btn-cancel {
            background: #e0d5c7;
            color: #333;
            border: 2px solid #1a4d7a;
        }

        .btn-cancel:hover {
            background: #d4c9bf;
            transform: translateY(-2px);
        }

        /* Character Counter */
        .char-counter {
            font-size: 0.85em;
            color: #999;
            margin-top: 5px;
            text-align: right;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .content-wrapper {
                padding: 20px;
            }

            .form-container {
                padding: 30px 20px;
            }

            .header-section h1 {
                font-size: 2em;
            }

            .button-group {
                flex-direction: column;
            }

            button[type="submit"],
            .btn-cancel {
                width: 100%;
            }

            .form-group textarea {
                min-height: 250px;
            }
        }

        /* Loading Animation for Submit Button */
        button[type="submit"]:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="page-container">
        <!-- Animated Background -->
        <div class="animated-background">
            <div class="book book1"></div>
            <div class="book book2"></div>
            <div class="book book3"></div>
            <div class="book book4"></div>
            <div class="book book5"></div>
            <div class="shelf-line shelf1"></div>
            <div class="shelf-line shelf2"></div>
        </div>

        <!-- Main Content -->
        <div class="content-wrapper">
            <div class="form-container">
                <!-- Header -->
                <div class="header-section">
                    <h1>
                        <div class="book-icon"></div>Buat Artikel Baru
                    </h1>
                    <p>Bagikan pengetahuan dan wawasan Anda dengan komunitas EduRead</p>
                </div>

                <!-- Error Messages -->
                @if ($errors->any())
                <div class="error-alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>✕ {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Form -->
                <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title Input -->
                    <div class="form-group">
                        <label for="title">
                            📖 Judul Artikel
                        </label>
                        <input 
                            id="title" 
                            name="title" 
                            type="text" 
                            value="{{ old('title') }}" 
                            class="@error('title') border-red-500 @enderror"
                            placeholder="Masukkan judul artikel yang menarik dan informatif..."
                            required
                        >
                        @error('title')
                            <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Body/Content Input -->
                    <div class="form-group">
                        <label for="body">
                            ✍️ Isi Artikel
                        </label>
                        <textarea 
                            id="body" 
                            name="body" 
                            class="@error('body') border-red-500 @enderror"
                            placeholder="Tulis isi artikel Anda di sini. Jelaskan topik secara detail, gunakan paragraf yang terstruktur, dan sertakan informasi yang bermanfaat bagi pembaca..."
                            required
                        >{{ old('body') }}</textarea>
                        <div class="char-counter">
                            <span id="charCount">0</span> karakter
                        </div>
                        @error('body')
                            <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Button Group -->
                    <div class="button-group">
                        <button type="submit">📤 Publikasikan Artikel</button>
                        <a href="{{ route('dashboard') }}" class="btn-cancel">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Character Counter
        const bodyTextarea = document.getElementById('body');
        const charCounter = document.getElementById('charCount');

        bodyTextarea.addEventListener('input', function() {
            charCounter.textContent = this.value.length;
        });

        // Form Validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const title = document.getElementById('title').value.trim();
            const body = document.getElementById('body').value.trim();

            if (!title || !body) {
                e.preventDefault();
                alert('Judul dan isi artikel tidak boleh kosong!');
                return false;
            }
        });
    </script>
</body>
</html>
@endsection