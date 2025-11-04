<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - EduRead</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --color-primary: #1a4d7a;
            --color-accent: #d4a574;
            --color-background: #faf8f3;
            --color-dark: #2d3142;
            --color-text-light: #5a5f7b;
            --color-border: #e8e6df;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--color-background);
            color: var(--color-dark);
            overflow: hidden;
        }

        /* Animated Library Background */
        .library-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--color-background) 0%, #faf3e0 100%);
            z-index: 0;
            overflow: hidden;
        }

        .bookshelf-lines {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: 
                repeating-linear-gradient(0deg, transparent, transparent calc(20vh - 1px), rgba(212, 165, 116, 0.08) calc(20vh - 1px), rgba(212, 165, 116, 0.08) 20vh);
            animation: slideShelf 20s linear infinite;
        }

        @keyframes slideShelf {
            0% { transform: translateY(0); }
            100% { transform: translateY(20vh); }
        }

        .floating-book {
            position: absolute;
            background: var(--color-primary);
            border-radius: 4px;
            opacity: 0.05;
            animation: float 6s ease-in-out infinite;
        }

        .book-1 { width: 60px; height: 80px; top: 10%; left: 5%; animation-delay: 0s; }
        .book-2 { width: 50px; height: 70px; top: 30%; right: 8%; animation-delay: 1s; }
        .book-3 { width: 55px; height: 75px; top: 60%; left: 10%; animation-delay: 2s; }
        .book-4 { width: 65px; height: 85px; top: 50%; right: 5%; animation-delay: 1.5s; }
        .book-5 { width: 45px; height: 65px; top: 20%; right: 20%; animation-delay: 2.5s; }
        .book-6 { width: 70px; height: 90px; top: 75%; left: 25%; animation-delay: 0.5s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
        }

        /* Main Container */
        .container {
            position: relative;
            z-index: 10;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Form Card */
        .login-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 165, 116, 0.2);
            border-radius: 20px;
            padding: 50px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 60px rgba(26, 77, 122, 0.1);
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Header */
        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-header h1 {
            font-size: 32px;
            font-weight: 700;
            color: var(--color-primary);
            margin-bottom: 10px;
        }

        .login-header p {
            color: var(--color-text-light);
            font-size: 14px;
        }

        /* Form Group */
        .form-group {
            margin-bottom: 24px;
        }

        label {
            display: block;
            font-weight: 500;
            color: var(--color-dark);
            margin-bottom: 8px;
            font-size: 14px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--color-border);
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
            background-color: rgba(250, 248, 243, 0.5);
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: var(--color-accent);
            background-color: white;
            box-shadow: 0 0 0 3px rgba(212, 165, 116, 0.1);
        }

        /* Error Messages */
        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: 6px;
        }

        /* Checkbox */
        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
        }

        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            border: 2px solid var(--color-border);
            border-radius: 6px;
            cursor: pointer;
            accent-color: var(--color-primary);
            transition: all 0.3s ease;
        }

        input[type="checkbox"]:hover {
            border-color: var(--color-accent);
        }

        .checkbox-group label {
            margin-left: 10px;
            margin-bottom: 0;
            cursor: pointer;
            font-weight: 400;
            color: var(--color-text-light);
        }

        /* Buttons Container */
        .button-group {
            display: flex;
            gap: 12px;
            align-items: center;
            justify-content: space-between;
        }

        .forgot-password {
            color: var(--color-primary);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .forgot-password:hover {
            color: var(--color-accent);
        }

        /* Submit Button */
        button[type="submit"] {
            background: linear-gradient(135deg, var(--color-primary) 0%, #0d2d4d 100%);
            color: white;
            padding: 12px 32px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(26, 77, 122, 0.3);
            white-space: nowrap;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(26, 77, 122, 0.4);
        }

        button[type="submit"]:active {
            transform: translateY(0);
        }

        /* Session Status */
        .session-status {
            background-color: #d4edda;
            color: #155724;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 24px;
            border: 1px solid #c3e6cb;
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                padding: 30px 20px;
            }

            .login-header h1 {
                font-size: 28px;
            }

            .button-group {
                flex-direction: column;
                gap: 12px;
            }

            button[type="submit"] {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Library Background -->
    <div class="library-bg">
        <div class="bookshelf-lines"></div>
        <div class="floating-book book-1"></div>
        <div class="floating-book book-2"></div>
        <div class="floating-book book-3"></div>
        <div class="floating-book book-4"></div>
        <div class="floating-book book-5"></div>
        <div class="floating-book book-6"></div>
    </div>

    <!-- Login Container -->
    <div class="container">
        <div class="login-card">
            <!-- Session Status -->
            @if ($errors->any())
                <div class="session-status">
                    Gagal masuk. Periksa email dan password Anda.
                </div>
            @endif

            <!-- Header -->
            <div class="login-header">
                <h1>EduRead</h1>
                <p>Platform Membaca Edukatif</p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        required 
                        autofocus 
                        autocomplete="username"
                        placeholder="nama@contoh.com"
                    >
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required 
                        autocomplete="current-password"
                        placeholder="Masukkan password"
                    >
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="checkbox-group">
                    <input 
                        type="checkbox" 
                        id="remember_me" 
                        name="remember"
                    >
                    <label for="remember_me">Ingat saya</label>
                </div>

                <!-- Buttons -->
                <div class="button-group">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password">
                            Lupa password?
                        </a>
                    @endif
                    <button type="submit">Masuk</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>