<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        // Get category IDs
        $bungaCategory = Category::where('slug', 'bunga-artificial')->first();
        $snackCategory = Category::where('slug', 'bucket-snack')->first();
        $uangCategory = Category::where('slug', 'bucket-uang')->first();
        $customCategory = Category::where('slug', 'custom-bucket')->first();

        $products = [
            // Bunga Artificial Products
            [
                'name' => 'Buket Mix Pink',
                'description' => 'Buket bunga artificial dengan tema pink yang cantik, cocok untuk ulang tahun dan anniversary. Dibuat dengan bahan berkualitas tinggi dan desain yang menarik. Produk handmade dengan sentuhan personal oleh pengrajin lokal Palembang.',
                'price' => 150000,
                'category_id' => $bungaCategory->id,
                'image' => 'products/buket-mix-pink.jpg',
                'stock' => 15,
                'is_active' => true
            ],
            [
                'name' => 'Buket Bunga Krivul',
                'description' => 'Buket bunga dengan model krivul premium, desain elegan dan mewah. Perfect untuk wisuda dan acara formal. Dapat disesuaikan dengan warna favorit Anda. Konsep "Bucket Murah Palembang" dengan kualitas terbaik.',
                'price' => 170000,
                'category_id' => $bungaCategory->id,
                'image' => 'products/buket-krivul.jpg',
                'stock' => 10,
                'is_active' => true
            ],
            [
                'name' => 'Bucket Full Bunga Premium Jumbo',
                'description' => 'Bucket bunga ukuran jumbo dengan kualitas premium, sangat cocok untuk wisuda dan anniversary. Menggunakan bunga artificial berkualitas tinggi yang tahan lama. Desain mewah dan elegan.',
                'price' => 200000,
                'category_id' => $bungaCategory->id,
                'image' => 'products/bucket-jumbo.jpg',
                'stock' => 8,
                'is_active' => true
            ],
            [
                'name' => 'Buket Romance Red',
                'description' => 'Buket bunga artificial dengan tema merah romantis, perfect untuk anniversary dan valentine. Desain eksklusif dengan perpaduan warna yang menawan. Handmade dengan detail sempurna.',
                'price' => 180000,
                'category_id' => $bungaCategory->id,
                'image' => 'products/buket-romance.jpg',
                'stock' => 7,
                'is_active' => true
            ],

            // Bucket Snack Products
            [
                'name' => 'Bucket Snack Jumbo',
                'description' => 'Bucket berisi berbagai snack favorit, perfect untuk segala acara. Dapat menyesuaikan isi snack sesuai permintaan. Harga terjangkau dengan kualitas terbaik. Cocok untuk ulang tahun dan gathering.',
                'price' => 80000,
                'category_id' => $snackCategory->id,
                'image' => 'products/bucket-snack.jpg',
                'stock' => 20,
                'is_active' => true
            ],
            [
                'name' => 'Bucket Snack Mini',
                'description' => 'Bucket snack ukuran mini dengan harga ekonomis. Cocok untuk acara kecil atau hadiah sederhana. Tetap dengan kualitas dan rasa terbaik. Praktis dan menarik.',
                'price' => 50000,
                'category_id' => $snackCategory->id,
                'image' => 'products/snack-mini.jpg',
                'stock' => 25,
                'is_active' => true
            ],

            // Bucket Uang Products
            [
                'name' => 'Bucket Uang Lucky Money',
                'description' => 'Bucket berisi uang dengan desain kreatif dan unik. Cocok untuk hadiah pernikahan, wisuda, atau anniversary. Nilai uang dapat disesuaikan. Desain exclusive dan memorable.',
                'price' => 300000,
                'category_id' => $uangCategory->id,
                'image' => 'products/bucket-uang.jpg',
                'stock' => 12,
                'is_active' => true
            ],

            // Custom Bucket Products
            [
                'name' => 'Custom Bucket Wisuda',
                'description' => 'Bucket custom khusus untuk wisuda dengan desain elegan. Dapat menambahkan foto, nama, atau pesan khusus. Konsultasi gratis untuk desain. Bebas request tema dan warna.',
                'price' => 250000,
                'category_id' => $customCategory->id,
                'image' => 'products/custom-wisuda.jpg',
                'stock' => 5,
                'is_active' => true
            ],
            [
                'name' => 'Custom Bucket Anniversary',
                'description' => 'Bucket custom spesial untuk anniversary dengan sentuhan romantis. Dapat disesuaikan dengan tema dan warna pasangan. Free konsultasi desain dengan tim kreatif kami.',
                'price' => 220000,
                'category_id' => $customCategory->id,
                'image' => 'products/custom-anniversary.jpg',
                'stock' => 6,
                'is_active' => true
            ],
            [
                'name' => 'Custom Bucket Ulang Tahun',
                'description' => 'Bucket custom untuk ulang tahun dengan tema yang disesuaikan. Bebas pilih warna, dekorasi, dan isi. Perfect untuk membuat hari spesial semakin berkesan.',
                'price' => 190000,
                'category_id' => $customCategory->id,
                'image' => 'products/custom-ultah.jpg',
                'stock' => 8,
                'is_active' => true
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $this->command->info('✅ Products data created successfully!');
        $this->command->info('🛍️ Total products: ' . count($products));
    }
}
