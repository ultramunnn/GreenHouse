@extends('layouts.main')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-primary mb-2 font-pacifico">GreenHouse</h1>
            <h2 class="text-2xl font-bold text-gray-900">Reset Password</h2>
            <p class="mt-2 text-gray-600">Masukkan password baru Anda</p>
        </div>

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
            <form class="space-y-6" action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                        class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary transition-colors">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                    <input id="password" name="password" type="password" required
                        class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary transition-colors">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary transition-colors">
                </div>

                <button type="submit" class="w-full flex justify-center py-3 px-4 rounded-lg text-white bg-primary hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors font-medium">
                    Reset Password
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="text-sm font-medium text-primary hover:text-secondary transition-colors">
                    <i class="ri-arrow-left-line align-middle"></i>
                    Kembali ke Halaman Login
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 