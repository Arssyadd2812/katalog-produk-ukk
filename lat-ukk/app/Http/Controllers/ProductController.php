<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    // Menampilkan detail produk + komentar
    public function show(Product $product)
    {
        $product->load('comments.user');
        return view('products.show', compact('product'));
    }

    // Form Tambah Produk (Admin)
    public function create()
    {
        return view('products.create');
    }

    // Simpan Produk Baru (Admin)
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Foto produk berhasil ditambahkan!');
    }

    // Form Edit Produk (Admin)
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Update Produk (Admin)
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus foto lama
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->title = $request->title;
        $product->description = $request->description;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Foto produk berhasil diperbarui!');
    }

    // Hapus Produk (Admin)
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Foto produk berhasil dihapus!');
    }
}