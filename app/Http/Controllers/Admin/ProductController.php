<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10); 
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * FILE BARU DISIMPAN LANGSUNG KE public/uploads/
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // PERBAIKAN: Menyimpan file ke root disk 'public' (yaitu public/uploads)
            // Menggunakan '' sebagai path folder untuk menghindari subfolder 'products/'
            $imagePath = $request->file('image')->store('', 'public'); 
            
            // CATATAN: Path yang tersimpan di DB adalah: namafileunik.jpg
            // Ini akan cocok dengan kode Blade Anda: asset('uploads/namafileunik.jpg')
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $imagePath
        ]);

        return redirect()->route('admin.products')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = $product->image;
        
        if ($request->hasFile('image')) {
            // 1. Hapus gambar lama
            if ($product->image) {
                // BUGFIX: Path di DB mengandung 'products/'. Kita bersihkan path yang lama
                $oldFilePath = str_replace('products/', '', $product->image);
                Storage::disk('public')->delete($oldFilePath); 
            }
            
            // 2. Simpan gambar baru ke root disk 'public' (uploads)
            $imagePath = $request->file('image')->store('', 'public'); // <-- Path kosong ('')
        }

        $updateData = [
            'name' => $data['name'],
            'price' => $data['price'],
            'description' => $data['description'],
            'category_id' => $data['category_id'],
            'image' => $imagePath 
        ];
        
        $product->update($updateData);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete image if exists
        if ($product->image) {
            // BUGFIX: Bersihkan 'products/' sebelum menghapus file fisik
            $filePath = str_replace('products/', '', $product->image);
            Storage::disk('public')->delete($filePath);
        }

        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }
}