<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GreenHouse</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div class="min-h-screen bg-white">
        <!-- Navigation -->
        <nav class="bg-white border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <span class="text-2xl font-bold text-green-700">GreenHouse</span>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <a href="{{ route('filament.user.auth.login') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-green-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Masuk
                            </a>
                            <a href="{{ route('filament.user.auth.register') }}" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
                <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                    <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                        <h1>
                            <span class="block text-sm font-semibold uppercase tracking-wide text-gray-500 sm:text-base lg:text-sm xl:text-base">
                                Selamat Datang di
                            </span>
                            <span class="mt-1 block text-4xl tracking-tight font-extrabold sm:text-5xl xl:text-6xl">
                                <span class="block text-gray-900">Solusi Pertanian</span>
                                <span class="block text-green-700">Modern untuk</span>
                                <span class="block text-green-700">Masa Depan</span>
                            </span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl">
                            Tingkatkan hasil panen Anda dengan teknologi greenhouse yang efisien, ramah lingkungan, dan berkelanjutan.
                        </p>
                        <div class="mt-8 sm:max-w-lg sm:mx-auto sm:text-center lg:text-left lg:mx-0">
                            <a href="{{ route('filament.user.auth.register') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Mulai Sekarang
                            </a>
                            <a href="#features" class="ml-4 inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200">
                                Pelajari Lebih Lanjut
                            </a>
                        </div>
                    </div>
                    <div class="mt-12 relative sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 lg:flex lg:items-center">
                        <div class="relative mx-auto w-full rounded-lg shadow-lg lg:max-w-md">
                            <img class="w-full" src="https://images.unsplash.com/photo-1492496913980-501348b61469?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2574&q=80" alt="Greenhouse">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

@extends('layouts.app')

@section('content')
    @include('pages.sections.hero')
    @include('pages.sections.cara-kerja')
    @include('pages.sections.misi')
    @include('pages.sections.tentang')
    @include('pages.sections.cta')
@endsection

@push('styles')
            <style>
    .hero-section {
        background-image: url('https://readdy.ai/api/search-image?query=A%20modern%20greenhouse%20with%20glass%20walls%20and%20ceiling%2C%20filled%20with%20lush%20green%20plants%20and%20vegetables.%20The%20image%20shows%20a%20clean%2C%20minimalist%20interior%20with%20organized%20rows%20of%20plants.%20Soft%20natural%20light%20filters%20through%20the%20glass%2C%20creating%20a%20serene%20atmosphere.%20The%20greenhouse%20has%20a%20sleek%20design%20with%20white%20structural%20elements%20and%20automated%20systems%20visible.%20The%20background%20shows%20a%20clear%20blue%20sky.&width=1600&height=800&seq=greenhouse-hero&orientation=landscape');
        background-size: cover;
        background-position: center;
    }
    .hero-overlay {
        background: linear-gradient(90deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.8) 50%, rgba(255,255,255,0.1) 100%);
    }
            </style>
@endpush
