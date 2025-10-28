<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        // Load about data from storage
        $aboutData = $this->getAboutData();

        return view('admin.about.index', compact('aboutData'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
        ]);

        // Save about data
        $aboutData = [
            'title' => $request->title,
            'content' => $request->content,
            'mission' => $request->mission,
            'vision' => $request->vision,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'website' => $request->website,
            'updated_at' => now()->toDateTimeString(),
        ];

        // Save to JSON file
        Storage::disk('local')->put('about.json', json_encode($aboutData));

        return redirect()->route('admin.about')->with('success', 'About page updated successfully.');
    }

    private function getAboutData()
    {
        if (Storage::disk('local')->exists('about.json')) {
            $data = json_decode(Storage::disk('local')->get('about.json'), true);
            return $data;
        }

        // Default data
        return [
            'title' => 'About Our Company',
            'content' => 'Welcome to our company! We are dedicated to providing the best services and products to our customers.',
            'mission' => 'To deliver exceptional quality and service to our clients.',
            'vision' => 'To be the leading company in our industry.',
            'address' => '123 Business Street, City, Country',
            'phone' => '+1 234 567 890',
            'email' => 'info@company.com',
            'website' => 'https://company.com',
            'updated_at' => now()->toDateTimeString(),
        ];
    }
}
