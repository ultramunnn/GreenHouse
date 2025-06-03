<!-- Navbar -->
<nav class="bg-white/90 backdrop-blur-sm fixed w-full z-10 shadow-sm">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <a href="#" class="text-primary font-['Pacifico'] text-2xl">logo</a>
        <div class="hidden md:flex space-x-8">
            <a href="#home" class="text-primary hover:text-secondary transition-colors font-medium">Beranda</a>
            <a href="#cara-kerja" class="text-primary hover:text-secondary transition-colors font-medium">Cara Kerja</a>
            <a href="#misi" class="text-primary hover:text-secondary transition-colors font-medium">Misi</a>
            <a href="#tentang" class="text-primary hover:text-secondary transition-colors font-medium">Tentang Kami</a>
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="text-primary hover:text-secondary transition-colors font-medium">Masuk</a>
                <a href="{{ route('register') }}" class="bg-primary text-white hover:bg-opacity-90 px-4 py-2 rounded-button transition-colors whitespace-nowrap">Daftar</a>
            </div>
        </div>
        <button class="md:hidden w-10 h-10 flex items-center justify-center text-primary" id="mobile-menu-button">
            <i class="ri-menu-line ri-lg"></i>
        </button>
    </div>
    <!-- Mobile Menu -->
    <div class="md:hidden hidden bg-white absolute w-full shadow-md" id="mobile-menu">
        <div class="container mx-auto px-6 py-3 flex flex-col space-y-4">
            <a href="#home" class="text-primary hover:text-secondary transition-colors py-2 font-medium">Beranda</a>
            <a href="#cara-kerja" class="text-primary hover:text-secondary transition-colors py-2 font-medium">Cara Kerja</a>
            <a href="#misi" class="text-primary hover:text-secondary transition-colors py-2 font-medium">Misi</a>
            <a href="#tentang" class="text-primary hover:text-secondary transition-colors py-2 font-medium">Tentang Kami</a>
            <a href="{{ route('login') }}" class="text-primary hover:text-secondary transition-colors py-2 font-medium">Masuk</a>
            <a href="{{ route('register') }}" class="text-primary hover:text-secondary transition-colors py-2 font-medium">Daftar</a>
        </div>
    </div>
</nav>
 