<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - EduRead</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #faf8f3 0%, #f5f1e8 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Animated Background */
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }

        /* Floating books animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(3deg); }
        }

        @keyframes float-slow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-40px) rotate(-2deg); }
        }

        .book {
            position: absolute;
            width: 60px;
            height: 80px;
            background: linear-gradient(135deg, #1a4d7a 0%, #2d6a9f 100%);
            border-radius: 4px;
            opacity: 0.15;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
        }

        .book:nth-child(1) {
            top: 10%;
            left: 5%;
            animation: float 6s ease-in-out infinite;
            width: 50px;
            height: 70px;
        }

        .book:nth-child(2) {
            top: 20%;
            right: 10%;
            animation: float-slow 8s ease-in-out infinite;
            background: linear-gradient(135deg, #d4a574 0%, #c9965f 100%);
        }

        .book:nth-child(3) {
            bottom: 15%;
            left: 15%;
            animation: float 7s ease-in-out infinite;
            width: 45px;
            height: 65px;
            animation-delay: 1s;
        }

        .book:nth-child(4) {
            top: 30%;
            right: 5%;
            animation: float-slow 9s ease-in-out infinite;
            animation-delay: 2s;
            width: 55px;
            height: 75px;
        }

        .book:nth-child(5) {
            bottom: 25%;
            right: 20%;
            animation: float 6.5s ease-in-out infinite;
            animation-delay: 1.5s;
        }

        /* Bookshelf lines */
        @keyframes shimmer {
            0%, 100% { opacity: 0.1; }
            50% { opacity: 0.25; }
        }

        .shelf-line {
            position: absolute;
            height: 1px;
            background: linear-gradient(90deg, transparent, #d4a574, transparent);
            width: 100%;
            animation: shimmer 4s ease-in-out infinite;
        }

        .shelf-line:nth-child(6) { top: 20%; animation-delay: 0s; }
        .shelf-line:nth-child(7) { top: 40%; animation-delay: 1s; }
        .shelf-line:nth-child(8) { top: 60%; animation-delay: 2s; }
        .shelf-line:nth-child(9) { top: 80%; animation-delay: 3s; }

        /* Container */
        .container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 450px;
            padding: 40px;
        }

        /* Card with glass morphism */
        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 165, 116, 0.2);
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(26, 77, 122, 0.15);
            animation: fadeIn 0.6s ease-out;
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

        /* Header */
        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header h1 {
            font-size: 28px;
            color: #1a4d7a;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .register-header p {
            color: #2d3142;
            font-size: 14px;
            opacity: 0.8;
        }

        /* Form Group */
        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #1a4d7a;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 16px;
            font-size: 14px;
            border: 2px solid #e8e4dd;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-family: inherit;
            color: #2d3142;
            background: #faf8f3;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #d4a574;
            background: white;
            box-shadow: 0 0 0 3px rgba(212, 165, 116, 0.1);
        }

        /* Error messages */
        .error-message {
            color: #dc2626;
            font-size: 12px;
            margin-top: 6px;
            display: block;
        }

        /* Button */
        .btn-register {
            width: 100%;
            padding: 14px;
            margin-top: 10px;
            background: linear-gradient(135deg, #1a4d7a 0%, #2d6a9f 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(26, 77, 122, 0.3);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(26, 77, 122, 0.4);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        /* Link styles */
        .auth-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #2d3142;
        }

        .auth-link a {
            color: #1a4d7a;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .auth-link a:hover {
            color: #d4a574;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .container {
                padding: 20px;
            }

            .register-card {
                padding: 30px 20px;
            }

            .register-header h1 {
                font-size: 24px;
            }

            .book {
                opacity: 0.08;
            }
        }

        /* Divider */
        .divider-text {
            text-align: center;
            margin: 20px 0;
            color: #999;
            font-size: 13px;
        }

        .divider-text::before {
            content: '';
            display: inline-block;
            width: 40%;
            height: 1px;
            background: #ddd;
            margin-right: 10px;
            vertical-align: middle;
        }

        .divider-text::after {
            content: '';
            display: inline-block;
            width: 40%;
            height: 1px;
            background: #ddd;
            margin-left: 10px;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <!-- Animated Background -->
    <div class="animated-bg">
        <div class="book"></div>
        <div class="book"></div>
        <div class="book"></div>
        <div class="book"></div>
        <div class="book"></div>
        <div class="shelf-line"></div>
        <div class="shelf-line"></div>
        <div class="shelf-line"></div>
        <div class="shelf-line"></div>
    </div>

    <!-- Register Container -->
    <div class="container">
        <div class="register-card">
            <!-- Header -->
            <div class="register-header">
                <h1>Bergabunglah</h1>
                <p>Daftar akun EduRead Anda sekarang</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}" novalidate>
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input 
                        id="name" 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        autofocus 
                        autocomplete="name"
                        placeholder="Masukkan nama Anda"
                    />
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autocomplete="username"
                        placeholder="nama@example.com"
                    />
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="new-password"
                        placeholder="Minimal 8 karakter"
                    />
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                    <input 
                        id="password_confirmation" 
                        type="password" 
                        name="password_confirmation" 
                        required 
                        autocomplete="new-password"
                        placeholder="Ulangi kata sandi Anda"
                    />
                    @error('password_confirmation')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Register Button -->
                <button type="submit" class="btn-register">Daftar Sekarang</button>

                <!-- Link to Login -->
                <div class="auth-link">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>