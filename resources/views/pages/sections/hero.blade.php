{{-- 
    View Hero Section
    Bagian ini menampilkan tampilan utama (hero section) dari halaman
    Berisi elemen-elemen visual utama seperti judul, deskripsi, dan gambar
--}}
<!-- Hero Section -->
<section id="home" class="hero-section w-full h-scree flex items-center pt-16">
    {{-- Container utama untuk hero section dengan pengaturan padding dan background --}}
    <div class="hero-overlay w-full min-h-screen flex items-center">
        <div class="container mx-auto px-6 py-20">
            {{-- Bagian konten hero yang berisi judul dan deskripsi --}}
            <div class="w-full md:w-1/2 lg:w-2/5">
                {{-- Judul utama dengan animasi fade-up --}}
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-primary mb-6">Solusi Pertanian Modern untuk Masa Depan</h1>
                {{-- Deskripsi dengan animasi fade-up dan delay --}}
                <p class="text-lg md:text-xl text-gray-700 mb-8">Tingkatkan hasil panen Anda dengan teknologi greenhouse yang efisien, ramah lingkungan, dan berkelanjutan.</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ url('/admin/register') }}" class="bg-primary text-white px-8 py-3 rounded-button font-medium hover:bg-opacity-90 transition-all whitespace-nowrap text-center">Mulai Sekarang</a>
                   
                    <a href="#cara-kerja" class="border-2 border-primary text-primary px-8 py-3 rounded-button font-medium hover:bg-primary hover:bg-opacity-10 transition-all whitespace-nowrap text-center">Pelajari Lebih Lanjut</a>
                </div>
            </div>
        </div>
    </div>
</section> 