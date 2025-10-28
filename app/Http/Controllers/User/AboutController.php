<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index()
    {
        $aboutData = [
            'name' => 'Roope.id',
            'location' => 'Plaju, Palembang, Sumatera Selatan',
            'instagram' => '@roope.id',
            'description' => 'Roope.id merupakan UMKM asal Palembang yang berfokus pada pembuatan dan penjualan bucket (buket) untuk berbagai acara, seperti ulang tahun, wisuda, anniversary, dan hari spesial lainnya. Roope.id dikenal dengan konsep "Bucket Murah Palembang" yang menonjolkan keindahan visual dengan harga terjangkau serta layanan kustom sesuai permintaan pelanggan.',
            'products' => [
                'Bucket Bunga Artificial',
                'Bucket Snack',
                'Bucket Uang',
                'Bucket Custom Request'
            ],
            'advantages' => [
                'Harga terjangkau untuk semua kalangan',
                'Layanan pesanan kustom sesuai permintaan',
                'Produk handmade oleh pengrajin lokal Palembang',
                'Desain kreatif dan unik'
            ]
        ];

        return view('user.about', compact('aboutData'));
    }
}
