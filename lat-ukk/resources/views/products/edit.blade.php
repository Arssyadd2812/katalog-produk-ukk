<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-alert />

            <!-- Data produk -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="font-bold mb-4">Data Produk</h3>
                <form action="{{ route('products.update', $product) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-input-label for="name" value="Nama Produk" />
                        <x-text-input id="name" name="name" type="text" class="block mt-1 w-full" :value="old('name', $product->name)" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" value="Deskripsi" />
                        <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $product->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-input-label for="price" value="Harga (Rp)" />
                            <x-text-input id="price" name="price" type="number" min="0" step="0.01" class="block mt-1 w-full" :value="old('price', $product->price)" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="stock" value="Stok" />
                            <x-text-input id="stock" name="stock" type="number" min="0" step="1" class="block mt-1 w-full" :value="old('stock', $product->stock)" required />
                            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded">Batal</a>
                        <x-primary-button>Update</x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Tambah foto -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="font-bold mb-4">Tambah Foto</h3>
                <form action="{{ route('products.photos.store', $product) }}" method="POST" enctype="multipart/form-data" class="flex items-start space-x-2">
                    @csrf
                    <div class="flex-1">
                        <input type="file" name="photo" class="block w-full" accept=".jpg,.jpeg,.png" required>
                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                    </div>
                    <x-primary-button>Upload</x-primary-button>
                </form>
                <p class="text-xs text-gray-500 mt-2">Format jpg/png, maksimal 2MB.</p>
            </div>

            <!-- Daftar foto -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="font-bold mb-4">Foto Produk ({{ $product->photos->count() }})</h3>
                <div class="space-y-4">
                    @forelse ($product->photos as $photo)
                        <div class="flex items-center space-x-4 border-b pb-4">
                            <img src="{{ asset('storage/' . $photo->photo_path) }}" class="w-24 h-24 object-cover rounded" alt="Foto produk">
                            <div class="flex-1 space-y-2">
                                <form action="{{ route('photos.update', $photo) }}" method="POST" enctype="multipart/form-data" class="flex items-center space-x-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="file" name="photo" class="text-sm" accept=".jpg,.jpeg,.png" required>
                                    <button type="submit" class="text-yellow-600 hover:text-yellow-900 text-sm font-semibold">Ganti</button>
                                </form>
                                <form action="{{ route('photos.destroy', $photo) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-semibold">Hapus foto</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm">Belum ada foto.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
