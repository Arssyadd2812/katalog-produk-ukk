<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <x-input-label for="name" value="Nama Produk" />
                        <x-text-input id="name" name="name" type="text" class="block mt-1 w-full" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" value="Deskripsi" />
                        <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-input-label for="price" value="Harga (Rp)" />
                            <x-text-input id="price" name="price" type="number" min="0" step="0.01" class="block mt-1 w-full" :value="old('price')" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="stock" value="Stok" />
                            <x-text-input id="stock" name="stock" type="number" min="0" step="1" class="block mt-1 w-full" :value="old('stock')" required />
                            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="photos" value="Foto Produk (jpg/png, maks 2MB per file, boleh lebih dari satu)" />
                        <input id="photos" type="file" name="photos[]" class="block mt-1 w-full" accept=".jpg,.jpeg,.png" multiple>
                        <x-input-error :messages="$errors->get('photos')" class="mt-2" />
                        <x-input-error :messages="$errors->get('photos.*')" class="mt-2" />
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white px-4 py-2 rounded">Batal</a>
                        <x-primary-button>Simpan</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
