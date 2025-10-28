<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GalleryTableSeeder extends Seeder
{
    public function run()
    {
        $galleries = [
            [
                'title' => 'Buket Wisuda Elegant',
                'description' => 'Buket spesial untuk wisuda dengan desain elegant dan mewah. Cocok untuk moment kelulusan yang berkesan.',
                'image' => 'gallery/wisuda-elegant.jpg',
                'is_active' => true
            ],
            [
                'title' => 'Bucket Snack Ulang Tahun',
                'description' => 'Bucket snack colorful untuk pesta ulang tahun yang meriah. Isi snack dapat disesuaikan.',
                'image' => 'gallery/snack-ultah.jpg',
                'is_active' => true
            ],
            [
                'title' => 'Custom Bucket Anniversary',
                'description' => 'Bucket custom untuk anniversary dengan sentuhan personal dan romantis.',
                'image' => 'gallery/anniversary-custom.jpg',
                'is_active' => true
            ],
            [
                'title' => 'Buket Bunga Premium',
                'description' => 'Buket bunga artificial premium dengan kualitas terbaik dan desain eksklusif.',
                'image' => 'gallery/bunga-premium.jpg',
                'is_active' => true
            ],
            [
                'title' => 'Bucket Uang Creative',
                'description' => 'Bucket uang dengan desain kreatif dan unik untuk hadiah spesial.',
                'image' => 'gallery/uang-creative.jpg',
                'is_active' => true
            ],
            [
                'title' => 'Snack Bucket Variant',
                'description' => 'Berbagai variant snack bucket yang tersedia dengan harga terjangkau.',
                'image' => 'gallery/snack-variant.jpg',
                'is_active' => true
            ],
            [
                'title' => 'Buket Romance Special',
                'description' => 'Buket romance dengan perpaduan warna yang menawan untuk pasangan.',
                'image' => 'gallery/romance-special.jpg',
                'is_active' => true
            ],
            [
                'title' => 'Custom Design Bucket',
                'description' => 'Contoh custom design bucket yang dapat disesuaikan dengan permintaan.',
                'image' => 'gallery/custom-design.jpg',
                'is_active' => true
            ]
        ];

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }

        $this->command->info('✅ Gallery data created successfully!');
        $this->command->info('🖼️ Total gallery items: ' . count($galleries));
    }
}
