{{-- 
    Komponen Footer
    Menampilkan bagian bawah dari setiap halaman
    Berisi informasi kontak, tautan cepat, dan media sosial
--}}
<!-- Footer -->
<footer class="bg-gray-800 text-white py-16">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            <div>
                <a href="#" class="text-white font-['Pacifico'] text-2xl mb-6 inline-block">GreenHouse</a>
                <p class="text-gray-300 mb-6">Solusi greenhouse modern untuk pertanian berkelanjutan dan hasil panen maksimal.</p>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-primary transition-colors">
                        <i class="ri-facebook-fill ri-lg"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-primary transition-colors">
                        <i class="ri-instagram-line ri-lg"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-primary transition-colors">
                        <i class="ri-twitter-x-line ri-lg"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center hover:bg-primary transition-colors">
                        <i class="ri-youtube-line ri-lg"></i>
                    </a>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-6">Tautan Cepat</h3>
                <ul class="space-y-3">
                    <li><a href="#home" class="text-gray-300 hover:text-white transition-colors">Beranda</a></li>
                    <li><a href="#cara-kerja" class="text-gray-300 hover:text-white transition-colors">Cara Kerja</a></li>
                    <li><a href="#misi" class="text-gray-300 hover:text-white transition-colors">Misi</a></li>
                    <li><a href="#tentang" class="text-gray-300 hover:text-white transition-colors">Tentang Kami</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Blog</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-6">Kontak</h3>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <div class="w-5 h-5 flex items-center justify-center mt-1">
                            <i class="ri-map-pin-line"></i>
                        </div>
                        <span class="text-gray-300">Jl. Tanaman Hijau No. 123, Jakarta Selatan</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-5 h-5 flex items-center justify-center mt-1">
                            <i class="ri-phone-line"></i>
                        </div>
                        <span class="text-gray-300">+62 812 3456 7890</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-5 h-5 flex items-center justify-center mt-1">
                            <i class="ri-mail-line"></i>
                        </div>
                        <span class="text-gray-300">info@greenhouse.id</span>
                    </li>
                </ul>
            </div>

        </div>

        <div class="border-t border-gray-700 mt-8 pt-4 text-center text-gray-200">
            <p>&copy; {{ date('Y') }} GreenHouse. Hak Cipta Dilindungi.</p>
        </div>
    </div>
</footer>
