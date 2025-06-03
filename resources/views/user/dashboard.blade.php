@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8">
                <h1 class="text-2xl font-medium text-gray-900">
                    Selamat Datang {{ auth()->user()->name }}
                </h1>

                <div class="mt-8 space-y-6">
                    <!-- Dashboard Content -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">
                            Ringkasan
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Dashboard Cards -->
                            <div class="bg-white p-6 rounded-lg shadow">
                                <h3 class="text-sm font-medium text-gray-500">Total Greenhouse</h3>
                                <p class="mt-2 text-3xl font-semibold text-gray-900">0</p>
                            </div>
                            
                            <div class="bg-white p-6 rounded-lg shadow">
                                <h3 class="text-sm font-medium text-gray-500">Status Perangkat</h3>
                                <p class="mt-2 text-3xl font-semibold text-green-600">Aktif</p>
                            </div>
                            
                            <div class="bg-white p-6 rounded-lg shadow">
                                <h3 class="text-sm font-medium text-gray-500">Notifikasi</h3>
                                <p class="mt-2 text-3xl font-semibold text-gray-900">0</p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">
                            Aksi Cepat
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <button class="inline-flex items-center justify-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
                                Tambah Greenhouse
                            </button>
                            <button class="inline-flex items-center justify-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
                                Lihat Monitoring
                            </button>
                            <button class="inline-flex items-center justify-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
                                Pengaturan
                            </button>
                            <button class="inline-flex items-center justify-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all">
                                Bantuan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 