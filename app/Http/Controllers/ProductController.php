<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Katalog publik: produk + foto
    public function index()
    {
        $products = Product::with('photos')->latest()->paginate(12);

        return view('products.index', compact('products'));
    }

    // Detail produk publik + foto
    public function show(Product $product)
    {
        $product->load(['photos', 'comments.user']);

        return view('products.show', compact('product'));
    }

    // Form tambah produk (admin)
    public function create()
    {
        return view('products.create');
    }

    // Simpan produk baru + foto (admin)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'stock' => $validated['stock'],
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $product->photos()->create([
                    'photo_path' => $file->store('products', 'public'),
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Form edit produk (admin)
    public function edit(Product $product)
    {
        $product->load('photos');

        return view('products.edit', compact('product'));
    }

    // Update data produk (admin, foto dikelola terpisah)
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // Hapus produk + semua file fotonya (admin)
    public function destroy(Product $product)
    {
        foreach ($product->photos as $photo) {
            Storage::disk('public')->delete($photo->photo_path);
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
