{{-- 
    Layout Utama
    Menampilkan template utama yang digunakan oleh semua halaman
    Berisi konfigurasi dasar HTML, meta tags, CSS, dan JavaScript yang dibutuhkan
--}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'GreenHouse') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    
    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#2C5F2D",
                        secondary: "#97BC62"
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        pacifico: ['Pacifico', 'cursive'],
                    },
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            color: #333;
        }
        .section-pattern {
            background-color: #F5FAF5;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2397BC62' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        input:focus, button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(151, 188, 98, 0.3);
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white/90 backdrop-blur-sm fixed w-full z-10 shadow-sm">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="text-primary font-pacifico text-2xl">GreenHouse</a>
            <div class="hidden md:flex items-center space-x-8">
                <a href="/" class="text-primary hover:text-secondary transition-colors font-medium">Beranda</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-primary hover:text-secondary transition-colors font-medium">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-primary hover:text-secondary transition-colors font-medium">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-primary hover:text-secondary transition-colors font-medium">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-opacity-90 transition-colors font-medium">Daftar</a>
                @endauth
            </div>
            <button class="md:hidden text-primary" id="mobile-menu-button">
                <i class="ri-menu-line ri-lg"></i>
            </button>
        </div>
        
        <!-- Mobile Menu -->
        <div class="md:hidden hidden bg-white absolute w-full shadow-md" id="mobile-menu">
            <div class="container mx-auto px-6 py-3 flex flex-col space-y-4">
                <a href="/" class="text-primary hover:text-secondary transition-colors py-2 font-medium">Beranda</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-primary hover:text-secondary transition-colors py-2 font-medium">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-primary hover:text-secondary transition-colors py-2 font-medium w-full text-left">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-primary hover:text-secondary transition-colors py-2 font-medium">Masuk</a>
                    <a href="{{ route('register') }}" class="text-primary hover:text-secondary transition-colors py-2 font-medium">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-16">
        @yield('content')
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                if (mobileMenu.classList.contains('hidden')) {
                    mobileMenuButton.innerHTML = '<i class="ri-menu-line ri-lg"></i>';
                } else {
                    mobileMenuButton.innerHTML = '<i class="ri-close-line ri-lg"></i>';
                }
            });
        });
    </script>
</body>
</html> 