<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::where('is_active', true)->latest()->get();
        return view('user.gallery', compact('galleries'));
    }
}
