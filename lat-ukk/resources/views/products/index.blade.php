<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Katalog Produk') }}
            </h2>
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        + Tambah Foto Produk
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

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse ($products as $product)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="font-bold text-xl mb-2">{{ $product->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($product->description, 100) }}</p>
                            
                            <div class="flex justify-between items-center">
                                <a href="{{ route('products.show', $product->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold text-sm">
                                    Lihat Detail & Komentar &rarr;
                                </a>

                                @auth
                                    @if(Auth::user()->role === 'admin')
                                        <div class="flex space-x-2">
                                            <a href="{{ route('products.edit', $product->id) }}" class="text-yellow-600 hover:text-yellow-900 text-sm font-semibold">Edit</a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto produk ini?')">
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
                    <div class="col-span-3 bg-white p-6 text-center text-gray-500 rounded-lg">
                        Belum ada foto produk yang diunggah.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>