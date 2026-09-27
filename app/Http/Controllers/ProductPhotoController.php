<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller
{
    // Tambah foto ke produk (admin)
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $product->photos()->create([
            'photo_path' => $request->file('photo')->store('products', 'public'),
        ]);

        return back()->with('success', 'Foto produk berhasil ditambahkan!');
    }

    // Ganti file foto (admin)
    public function update(Request $request, ProductPhoto $photo)
    {
        $validated = $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        Storage::disk('public')->delete($photo->photo_path);
        $photo->update([
            'photo_path' => $request->file('photo')->store('products', 'public'),
        ]);

        return back()->with('success', 'Foto produk berhasil diperbarui!');
    }

    // Hapus foto (admin)
    public function destroy(ProductPhoto $photo)
    {
        Storage::disk('public')->delete($photo->photo_path);
        $photo->delete();

        return back()->with('success', 'Foto produk berhasil dihapus!');
    }
}
