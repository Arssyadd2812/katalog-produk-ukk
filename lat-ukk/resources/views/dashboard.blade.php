<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-alert />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Halo, {{ Auth::user()->name }}! Kelola katalog produk dari sini.
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <div class="text-3xl font-bold text-indigo-700">{{ $productCount }}</div>
                    <div class="text-gray-600 text-sm mt-1">Total Produk</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <div class="text-3xl font-bold text-indigo-700">{{ $photoCount }}</div>
                    <div class="text-gray-600 text-sm mt-1">Total Foto</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                    <div class="text-3xl font-bold text-indigo-700">{{ $userCount }}</div>
                    <div class="text-gray-600 text-sm mt-1">User Terdaftar</div>
                </div>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('products.index') }}" class="bg-gray-600 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">
                    Lihat Katalog
                </a>
                <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    + Tambah Produk
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
