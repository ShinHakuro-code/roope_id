<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Bunga Artificial',
                'slug' => 'bunga-artificial',
                'description' => 'Bucket bunga artificial berbagai model dan ukuran untuk acara spesial'
            ],
            [
                'name' => 'Bucket Snack',
                'slug' => 'bucket-snack',
                'description' => 'Bucket berisi aneka snack favorit dengan harga terjangkau'
            ],
            [
                'name' => 'Bucket Uang',
                'slug' => 'bucket-uang',
                'description' => 'Bucket uang kreatif untuk hadiah wisuda, pernikahan, dan anniversary'
            ],
            [
                'name' => 'Custom Bucket',
                'slug' => 'custom-bucket',
                'description' => 'Bucket kombinasi custom sesuai permintaan dan tema pelanggan'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $this->command->info('✅ Categories data created successfully!');
        $this->command->info('📦 Total categories: ' . count($categories));
    }
}
