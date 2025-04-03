<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $category = Category::create([
            'name' => 'Knives',
        ]);

        $products = [
            [
                'name' => 'Classic Knife',
                'description' => 'A classic design with a reliable blade.',
                'price' => 49.99,
                'image' => 'classic-knife.jpg',
                'stock' => 100,
            ],
            [
                'name' => 'Butterfly Knife',
                'description' => 'Elegant butterfly design with smooth flipping action.',
                'price' => 89.99,
                'image' => 'butterfly-knife.jpg',
                'stock' => 75,
            ],
            [
                'name' => 'Karambit',
                'description' => 'Curved blade inspired by tiger claws.',
                'price' => 69.99,
                'image' => 'karambit.jpg',
                'stock' => 50,
            ],
            [
                'name' => 'Huntsman Knife',
                'description' => 'Versatile design for collectors.',
                'price' => 59.99,
                'image' => 'huntsman-knife.jpg',
                'stock' => 60,
            ],
            [
                'name' => 'Bayonet',
                'description' => 'Military-inspired design for collectors.',
                'price' => 79.99,
                'image' => 'bayonet.jpg',
                'stock' => 40,
            ],
            [
                'name' => 'Flip Knife',
                'description' => 'Compact folding design with quick deployment.',
                'price' => 54.99,
                'image' => 'flip-knife.jpg',
                'stock' => 80,
            ],
        ];

        foreach ($products as $product) {
            $category->products()->create($product);
        }
    }
}
