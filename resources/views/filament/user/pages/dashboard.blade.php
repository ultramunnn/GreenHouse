<x-filament-panels::page>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Sensor Data Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Data Sensor</h3>
                <i class="fi fi-rr-temperature-high text-primary-600 text-2xl"></i>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Suhu</span>
                    <span class="font-semibold">28°C</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Kelembaban</span>
                    <span class="font-semibold">65%</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">pH Tanah</span>
                    <span class="font-semibold">6.5</span>
                </div>
            </div>
        </div>

        <!-- Device Status Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Status Perangkat</h3>
                <i class="fi fi-rr-computer text-primary-600 text-2xl"></i>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Pompa Air</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Aktif
                    </span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Kipas</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        Nonaktif
                    </span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Lampu UV</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        Aktif
                    </span>
                </div>
            </div>
        </div>

        <!-- Quick Actions Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Aksi Cepat</h3>
                <i class="fi fi-rr-apps text-primary-600 text-2xl"></i>
            </div>
            <div class="space-y-3">
                <button class="w-full bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition-colors">
                    Kontrol Perangkat
                </button>
                <button class="w-full bg-primary-100 text-primary-700 px-4 py-2 rounded-lg hover:bg-primary-200 transition-colors">
                    Lihat Laporan
                </button>
                <button class="w-full bg-primary-100 text-primary-700 px-4 py-2 rounded-lg hover:bg-primary-200 transition-colors">
                    Pengaturan
                </button>
            </div>
        </div>
    </div>
</x-filament-panels::page> 