<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Foto Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Nama Produk</label>
                        <input type="text" name="title" value="{{ $product->title }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                        <textarea name="description" rows="4" class="w-full border-gray-300 rounded-md shadow-sm">{{ $product->description }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Foto Saat Ini</label>
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-32 h-32 object-cover rounded mb-2">
                        <label class="block text-gray-700 font-bold mb-2">Ganti Foto (Opsional)</label>
                        <input type="file" name="image" class="w-full border-gray-300" accept="image/*">
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
                        <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>