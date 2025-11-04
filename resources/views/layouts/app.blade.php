<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'EduRead')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @yield('styles')
    <style>
        /* Navbar Styles */
        .navbar {
            background: #1a4d7a;
            padding: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            padding: 0.75rem 1rem;
            background: #15406a;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 1rem;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            color: #ffffff;
            font-weight: 700;
            font-size: 1.5rem;
            transition: transform 0.3s ease;
        }

        .nav-brand:hover {
            transform: translateY(-1px);
            color: #d4a574;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-link {
            color: #ffffff;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 0;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: #d4a574;
            transition: width 0.3s ease;
        }

        .nav-link:hover {
            color: #d4a574;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn-auth {
            padding: 0.5rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-login {
            color: #ffffff;
            background: transparent;
            border: 2px solid #ffffff;
        }

        .btn-login:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: #d4a574;
            color: #d4a574;
        }

        .btn-register {
            background: #d4a574;
            color: #1a4d7a;
            border: none;
        }

        .btn-register:hover {
            background: #c9934d;
            transform: translateY(-1px);
        }

        .btn-create {
            background: #d4a574;
            color: #1a4d7a;
            border: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
        }

        .btn-create:hover {
            background: #c9934d;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .btn-create span {
            font-size: 1.2rem;
            line-height: 1;
        }

        /* Alert Toast Styles */
        .alert-toast {
            position: fixed;
            top: 2rem;
            right: 2rem;
            z-index: 1000;
            animation: slideIn 0.5s ease forwards;
        }

        .alert-content {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: rgba(22, 163, 74, 0.95);
            backdrop-filter: blur(10px);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .alert-icon {
            width: 1.5rem;
            height: 1.5rem;
            flex-shrink: 0;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .nav-buttons {
                gap: 0.5rem;
            }

            .btn-auth {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }
        }
    </style>
    <script>
        window.onload = function() {
            // Handle alert auto-hide
            const alert = document.getElementById('successAlert');
            if (alert) {
                setTimeout(() => {
                    alert.style.animation = 'slideOut 0.5s ease forwards';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            }

            // Handle navbar scroll effect
            const navbar = document.querySelector('.navbar');
            let lastScroll = 0;
            
            window.addEventListener('scroll', () => {
                const currentScroll = window.pageYOffset;
                
                // Add scrolled class for styling
                if (currentScroll > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
                
                // Hide/show navbar based on scroll direction
                if (currentScroll > lastScroll && currentScroll > 100) {
                    navbar.style.transform = 'translateY(-100%)';
                } else {
                    navbar.style.transform = 'translateY(0)';
                }
                
                lastScroll = currentScroll;
            });

            // Add smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Add fade-in animation for content
            const fadeElements = document.querySelectorAll('.fade-in');
            const appearOptions = {
                threshold: 0.15,
                rootMargin: "0px 0px -50px 0px"
            };

            const appearOnScroll = new IntersectionObserver(function(entries, observer) {
                entries.forEach(entry => {
                    if (!entry.isIntersecting) return;
                    entry.target.classList.add('appear');
                    observer.unobserve(entry.target);
                });
            }, appearOptions);

            fadeElements.forEach(elem => {
                appearOnScroll.observe(elem);
            });
        };
    </script>
    <style>
        /* Global Animation Classes */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .fade-in.appear {
            opacity: 1;
            transform: translateY(0);
        }

        /* Loading Animation */
        .loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-icon {
            width: 50px;
            height: 50px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #1a4d7a;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Smooth Scrollbar */
        html {
            scroll-behavior: smooth;
        }

        /* Mobile Menu Animation */
        @media (max-width: 768px) {
            .nav-links {
                position: fixed;
                top: 0;
                right: -100%;
                height: 100vh;
                width: 80%;
                max-width: 300px;
                background: #1a4d7a;
                flex-direction: column;
                padding: 80px 20px;
                transition: right 0.3s ease;
            }

            .nav-links.active {
                right: 0;
            }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Loading Screen -->
    <div class="loading" id="loadingScreen">
        <div class="loading-icon"></div>
    </div>
    
    <script>
        // Remove loading screen when page is loaded
        window.addEventListener('load', function() {
            const loader = document.getElementById('loadingScreen');
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.display = 'none';
            }, 500);
        });
    </script>
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="nav-brand">
                <span>📚</span>
                <span>EduRead</span>
            </a>
            
            <div class="nav-links">
                <a href="{{ route('home') }}" class="nav-link">Beranda</a>
                <a href="#articles" class="nav-link">Artikel</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                @endauth
            </div>

            <div class="nav-buttons">
                @auth
                    <a href="{{ route('articles.create') }}" class="btn-auth btn-create">
                        <span>+</span> Buat Artikel
                    </a>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit" class="btn-auth btn-login">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-auth btn-login">Login</a>
                    <a href="{{ route('register') }}" class="btn-auth btn-register">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container mx-auto py-8">
    @if(session('success'))
        <div class="alert-toast" id="successAlert">
            <div class="alert-content">
                <svg xmlns="http://www.w3.org/2000/svg" class="alert-icon" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <p>{{ session('success') }}</p>
            </div>
        </div>
        @endif
        @yield('content')
    </main>
</body>
</html>