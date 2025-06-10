{{-- 
    Halaman Registrasi
    Menampilkan form registrasi untuk pengguna baru
    Menyediakan fitur rate limiting dan validasi
--}}

@php
    use Filament\Support\Facades\FilamentView;
@endphp

<x-filament-panels::page.simple>
    <div class="absolute left-4 top-4 md:left-8 md:top-8">
    <a href="/" class="inline-block">
            <span class="flex items-center bg-white px-4 py-2 rounded-lg border-2 border-green-600 text-sm font-medium text-green-700 hover:bg-green-600 hover:text-white transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali
            </span>
        </a>
    </div>

    @if (FilamentView::hasSpaMode())
        <head>
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet" />
        </head>
    @endif

    <form wire:submit.prevent="register" class="space-y-8">
        {{ $this->form }}

        <x-filament::button
            type="submit"
            class="w-full"
        >
            {{ __('Daftar') }}
        </x-filament::button>
    </form>

    <div class="text-center mt-6">
        <x-filament::link
            href="/login"
            class="text-sm"
        >
            {{ __('Sudah punya akun? Login') }}
        </x-filament::link>
    </div>
</x-filament-panels::page.simple> 