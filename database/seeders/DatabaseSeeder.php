<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            ProductsTableSeeder::class,
            GalleryTableSeeder::class,
        ]);

        $this->command->info('🎉 ALL DATA SEEDED SUCCESSFULLY!');
        $this->command->info('================================');
        $this->command->info('🚀 Roope.id E-Commerce Ready!');
        $this->command->info('📧 Admin: admin@roope.id / admin123');
        $this->command->info('📧 User: user@example.com / user123');
        $this->command->info('🛍️ Products: 11 items');
        $this->command->info('📦 Categories: 4 categories');
        $this->command->info('🖼️ Gallery: 8 items');
        $this->command->info('================================');
    }
}
