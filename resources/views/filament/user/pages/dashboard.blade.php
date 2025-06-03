<x-filament-panels::page>
    <x-filament::grid>
        {{-- Summary Cards --}}
        <x-filament::grid.column span="4">
            <x-filament::card>
                <div class="flex items-center gap-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Total Greenhouse</h3>
                        <p class="mt-2 text-3xl font-semibold text-gray-900">0</p>
                    </div>
                </div>
            </x-filament::card>
        </x-filament::grid.column>

        <x-filament::grid.column span="4">
            <x-filament::card>
                <div class="flex items-center gap-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Status Perangkat</h3>
                        <p class="mt-2 text-3xl font-semibold text-green-600">Aktif</p>
                    </div>
                </div>
            </x-filament::card>
        </x-filament::grid.column>

        <x-filament::grid.column span="4">
            <x-filament::card>
                <div class="flex items-center gap-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Notifikasi</h3>
                        <p class="mt-2 text-3xl font-semibold text-gray-900">0</p>
                    </div>
                </div>
            </x-filament::card>
        </x-filament::grid.column>
    </x-filament::grid>

    {{-- Quick Actions --}}
    <x-filament::section class="mt-8">
        <x-slot name="heading">Aksi Cepat</x-slot>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <x-filament::button wire:click="redirectToGreenhouse">
                Tambah Greenhouse
            </x-filament::button>

            <x-filament::button wire:click="redirectToMonitoring">
                Lihat Monitoring
            </x-filament::button>

            <x-filament::button wire:click="redirectToSettings">
                Pengaturan
            </x-filament::button>

            <x-filament::button wire:click="redirectToHelp">
                Bantuan
            </x-filament::button>
        </div>
    </x-filament::section>
</x-filament-panels::page> 