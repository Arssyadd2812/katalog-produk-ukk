<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Detail Produk -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="w-full h-96 object-cover rounded-md mb-4">
                <h1 class="text-2xl font-bold mb-2">{{ $product->title }}</h1>
                <p class="text-gray-700 mb-4">{{ $product->description }}</p>
                <a href="{{ route('products.index') }}" class="text-gray-600 hover:underline">&larr; Kembali ke Katalog</a>
            </div>

            <!-- Bagian Komentar -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-bold mb-4">Komentar</h3>

                @auth
                    <form action="{{ route('comments.store') }}" method="POST" class="mb-6">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <textarea name="comment_text" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Tulis komentar..." required></textarea>
                        <button type="submit" class="mt-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md">Kirim Komentar</button>
                    </form>
                @else
                    <p class="text-sm text-gray-500 mb-4">Silakan <a href="{{ route('login') }}" class="text-indigo-600 underline">Login</a> untuk menambahkan komentar.</p>
                @endauth

                <!-- Daftar Komentar -->
                <div class="space-y-4">
                    @forelse ($product->comments as $comment)
                        <div class="border-b pb-3">
                            <div class="flex justify-between items-center mb-1">
                                <span class="font-semibold text-gray-800">{{ $comment->user->name }}</span>
                                <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-600 text-sm">{{ $comment->comment_text }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm">Belum ada komentar.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>