<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(12); // ← GANTI get() MENJADI paginate()
        return view('admin.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string'
        ]);

        $imagePath = $request->file('image')->store('gallery', 'public');

        Gallery::create([
            'title' => $request->title,
            'image' => $imagePath,
            'description' => $request->description
        ]);

        return redirect()->route('admin.gallery')->with('success', 'Image added to gallery successfully.');
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string'
        ]);

        $imagePath = $gallery->image;
        if ($request->hasFile('image')) {
            // Delete old image
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }
            $imagePath = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update([
            'title' => $request->title,
            'image' => $imagePath,
            'description' => $request->description
        ]);

        return redirect()->route('admin.gallery')->with('success', 'Gallery image updated successfully.');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Delete image
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery')->with('success', 'Gallery image deleted successfully.');
    }
}
