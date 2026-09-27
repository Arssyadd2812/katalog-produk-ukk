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
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @forelse ($products as $product)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        @if ($product->photos->isNotEmpty())
                            <img src="{{ asset('storage/' . $product->photos->first()->photo_path) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500 text-sm">
                                Tanpa foto
                            </div>
                        @endif
                        <div class="p-6">
                            <h3 class="font-bold text-xl mb-1">{{ $product->name }}</h3>
                            <p class="text-indigo-700 font-semibold mb-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="text-gray-500 text-xs mb-2">Stok: {{ $product->stock }}</p>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($product->description, 100) }}</p>

                            <div class="flex justify-between items-center">
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
                    <div class="col-span-full bg-white p-6 text-center text-gray-500 rounded-lg">
                        Belum ada produk.
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
