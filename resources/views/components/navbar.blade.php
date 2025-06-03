<!-- Navbar -->
<nav class="bg-white/90 backdrop-blur-sm fixed w-full z-10 shadow-sm">
    <div class="container mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
            <a href="/" class="text-primary font-['Pacifico'] text-2xl">logo</a>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="#home" class="text-primary hover:text-secondary transition-colors font-medium">Beranda</a>
                <a href="#cara-kerja" class="text-primary hover:text-secondary transition-colors font-medium">Cara Kerja</a>
                <a href="#misi" class="text-primary hover:text-secondary transition-colors font-medium">Misi</a>
                <a href="#tentang" class="text-primary hover:text-secondary transition-colors font-medium">Tentang Kami</a>
                
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('filament.admin.pages.dashboard') }}" class="text-primary hover:text-secondary transition-colors font-medium">Dashboard</a>
                    @else
                        <a href="{{ route('filament.user.pages.dashboard') }}" class="text-primary hover:text-secondary transition-colors font-medium">Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline-flex">
                        @csrf
                        <button type="submit" class="text-primary hover:text-secondary transition-colors font-medium">Keluar</button>
                    </form>
                @else
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('filament.user.auth.login') }}" class="text-primary hover:text-secondary transition-colors font-medium">Masuk</a>
                        <a href="{{ route('filament.user.auth.register') }}" class="bg-primary text-white hover:bg-opacity-90 px-4 py-2 rounded-lg transition-colors">Daftar</a>
                    </div>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button class="md:hidden w-10 h-10 flex items-center justify-center text-primary" id="mobile-menu-button">
                <i class="ri-menu-line ri-lg"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden hidden bg-white absolute w-full shadow-md" id="mobile-menu">
        <div class="container mx-auto px-6 py-4 flex flex-col space-y-4">
            <a href="#home" class="text-primary hover:text-secondary transition-colors font-medium">Beranda</a>
            <a href="#cara-kerja" class="text-primary hover:text-secondary transition-colors font-medium">Cara Kerja</a>
            <a href="#misi" class="text-primary hover:text-secondary transition-colors font-medium">Misi</a>
            <a href="#tentang" class="text-primary hover:text-secondary transition-colors font-medium">Tentang Kami</a>
            
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('filament.admin.pages.dashboard') }}" class="text-primary hover:text-secondary transition-colors font-medium">Dashboard</a>
                @else
                    <a href="{{ route('filament.user.pages.dashboard') }}" class="text-primary hover:text-secondary transition-colors font-medium">Dashboard</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-primary hover:text-secondary transition-colors font-medium w-full text-left">Keluar</button>
                </form>
            @else
                <div class="flex flex-col space-y-2">
                    <a href="{{ route('filament.user.auth.login') }}" class="text-primary hover:text-secondary transition-colors font-medium">Masuk</a>
                    <a href="{{ route('filament.user.auth.register') }}" class="bg-primary text-white hover:bg-opacity-90 px-4 py-2 rounded-lg text-center transition-colors">Daftar</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
 