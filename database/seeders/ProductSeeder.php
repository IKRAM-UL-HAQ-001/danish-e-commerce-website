<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $cat1 = Category::firstOrCreate(['name' => 'Eye Lines'], ['slug' => 'eye-lines']);
        $cat2 = Category::firstOrCreate(['name' => 'Makeup'], ['slug' => 'makeup']);
        $cat3 = Category::firstOrCreate(['name' => 'Skin Care'], ['slug' => 'skin-care']);

        $products = [
            ['name' => 'Brow setter shaping', 'price' => 12.00, 'image' => 'products/trending-product-thumb1_1.jpg', 'cat' => $cat1],
            ['name' => 'Soft Line Eye Kajal', 'price' => 12.00, 'image' => 'products/trending-product-thumb1_2.jpg', 'cat' => $cat1],
            ['name' => 'Lush Glow Cream', 'price' => 12.00, 'image' => 'products/trending-product-thumb1_3.jpg', 'cat' => $cat3],
            ['name' => 'Luxe Matte Lipstick', 'price' => 12.00, 'image' => 'products/trending-product-thumb1_4.jpg', 'cat' => $cat2],
            ['name' => 'DreamSkin Primer', 'price' => 12.00, 'image' => 'products/trending-product-thumb1_5.jpg', 'cat' => $cat2],
            ['name' => 'Fresh Dew Face Mist', 'price' => 12.00, 'image' => 'products/trending-product-thumb1_6.jpg', 'cat' => $cat3],
            ['name' => 'Pro Define Eyelash Curler', 'price' => 12.00, 'image' => 'products/trending-product-thumb1_7.jpg', 'cat' => $cat1],
        ];

        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($products as $p) {
            Product::create([
                'name' => $p['name'],
                'slug' => Str::slug($p['name']),
                'price' => $p['price'],
                'image' => $p['image'],
                'category_id' => $p['cat']->id,
                'stock' => 100,
                'status' => 1,
                'description' => 'Professional beauty product.',
            ]);
        }
    }
}
