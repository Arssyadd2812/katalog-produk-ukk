<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Katalog Produk') }}
            </h2>
            @auth
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        + Tambah Produk
                    </a>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert />

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @forelse ($products as $product)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        @if ($product->photos->isNotEmpty())
                            <img src="{{ asset('storage/' . $product->photos->first()->photo_path) }}" alt="Foto {{ $product->name }}" loading="lazy" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex flex-col items-center justify-center text-gray-500 gap-2">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-sm">Belum ada foto</span>
                            </div>
                        @endif
                        <div class="p-6">
                            <h3 class="font-bold text-xl mb-1 line-clamp-1" title="{{ $product->name }}">{{ $product->name }}</h3>
                            <p class="text-indigo-700 font-semibold mb-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="text-gray-500 text-xs mb-2">Stok: {{ $product->stock }}</p>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($product->description, 100) }}</p>

        <div class="flex flex-wrap justify-between items-center gap-2">
                                <a href="{{ route('products.show', $product) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold text-sm">
                                    Lihat Detail &rarr;
                                </a>

                                @auth
                                    @if (Auth::user()->role === 'admin')
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('products.edit', $product) }}" class="text-yellow-600 hover:text-yellow-900 text-sm font-semibold">Edit</a>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini beserta fotonya?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-semibold">Hapus</button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white p-10 text-center rounded-lg">
                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <p class="text-gray-500 mb-4">Belum ada produk di katalog.</p>
                        @auth
                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('products.create') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    + Tambah Produk Pertama
                                </a>
                            @endif
                        @endauth
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
