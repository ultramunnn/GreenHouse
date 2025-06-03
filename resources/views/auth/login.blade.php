@extends('layouts.main')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-primary mb-2 font-pacifico">GreenHouse</h1>
            <h2 class="text-2xl font-bold text-gray-900">Selamat Datang Kembali</h2>
            <p class="mt-2 text-gray-600">Masuk ke akun Anda untuk melanjutkan</p>
        </div>

        @if (session('status'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 border-l-4 border-green-400">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="ri-checkbox-circle-line text-green-400 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">{{ session('status') }}</p>
                </div>
            </div>
        </div>
        @endif

        @if ($errors->any())
        <div class="mb-4 p-4 rounded-lg bg-red-50 border-l-4 border-red-400">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="ri-error-warning-line text-red-400 text-xl"></i>
                </div>
                <div class="ml-3">
                    <ul class="list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <div class="bg-white p-8 shadow-sm rounded-xl">
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                        class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary transition-colors">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary transition-colors">
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" 
                            class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded transition-colors">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                            Ingat Saya
                        </label>
                    </div>

                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-primary hover:text-secondary transition-colors">
                        Lupa Password?
                    </a>
                </div>

                <button type="submit" class="w-full flex justify-center py-3 px-4 rounded-lg text-white bg-primary hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors font-medium">
                    Masuk
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-medium text-primary hover:text-secondary transition-colors">
                        Daftar Sekarang
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection 