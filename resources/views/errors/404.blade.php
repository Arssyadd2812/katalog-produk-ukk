<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>404 — Halaman tidak ditemukan</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex items-center justify-center px-4">
            <div class="bg-white shadow-sm rounded-lg p-10 text-center max-w-md w-full">
                <div class="text-6xl font-bold text-indigo-600 mb-2">404</div>
                <h1 class="text-xl font-semibold text-gray-800 mb-2">Halaman tidak ditemukan</h1>
                <p class="text-gray-500 text-sm mb-6">Alamat yang kamu tuju tidak ada atau sudah dihapus.</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-indigo-600 hover:bg-indigo-800 text-white font-bold py-2 px-4 rounded">
                    &larr; Kembali ke Katalog
                </a>
            </div>
        </div>
    </body>
</html>
