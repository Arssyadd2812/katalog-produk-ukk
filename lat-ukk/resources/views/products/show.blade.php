<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-alert />

            <!-- Detail Produk -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                @if ($product->photos->isNotEmpty())
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        @foreach ($product->photos as $photo)
                            <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover rounded-md">
                        @endforeach
                    </div>
                @else
                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center text-gray-500 rounded-md mb-4">
                        Tanpa foto
                    </div>
                @endif
                <h1 class="text-2xl font-bold mb-1">{{ $product->name }}</h1>
                <p class="text-indigo-700 font-semibold mb-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="text-gray-500 text-sm mb-3">Stok: {{ $product->stock }}</p>
                <p class="text-gray-700 mb-4">{{ $product->description }}</p>
                <a href="{{ route('products.index') }}" class="text-gray-600 hover:underline">&larr; Kembali ke Katalog</a>
            </div>

            <!-- Komentar -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-bold mb-4">Komentar</h3>

                @auth
                    <form action="{{ route('comments.store') }}" method="POST" class="mb-6">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <textarea name="comment" rows="3" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Tulis komentar... (maks 1000 karakter)" required>{{ old('comment') }}</textarea>
                        <x-input-error :messages="$errors->get('comment')" class="mt-2" />
                        <x-primary-button class="mt-2">Kirim Komentar</x-primary-button>
                    </form>
                @else
                    <p class="text-sm text-gray-500 mb-4">Silakan <a href="{{ route('login') }}" class="text-indigo-600 underline">login</a> untuk menambahkan komentar.</p>
                @endauth

                <div class="space-y-4">
                    @forelse ($product->comments as $comment)
                        <div class="border-b pb-3">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-semibold text-gray-800">{{ $comment->user->name }}</span>
                                <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-600 text-sm">{{ $comment->comment }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm">Belum ada komentar.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
