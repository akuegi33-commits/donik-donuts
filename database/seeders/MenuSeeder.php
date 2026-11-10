<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::firstOrCreate(
            ['slug' => 'donuts-dunki'],
            [
                'name' => 'Donuts Dunki',
                'description' => 'Aneka varian donat',
                'is_active' => true,
            ]
        );

        $category->update([
            'name' => 'Donuts Dunki',
            'is_active' => true,
        ]);

        $otherCategoryIds = Category::where('id', '!=', $category->id)->pluck('id');
        if ($otherCategoryIds->isNotEmpty()) {
            Category::whereIn('id', $otherCategoryIds)->update(['is_active' => false]);
            Product::whereIn('category_id', $otherCategoryIds)->update(['is_available' => false]);
        }

        $menu = [
<<<<<<< HEAD
            'TEA SERIES' => [
                ['name' => 'Original Tea',       'price' => 10000, 'stock' => 100],
                ['name' => 'Lemon Tea',           'price' => 12000, 'stock' => 100, 'image' => 'images/products/lemon-tea.jpg'],
                ['name' => 'Honey Lemon Tea',     'price' => 14000, 'stock' => 80],
                ['name' => 'Jasmine Tea',         'price' => 12000, 'stock' => 80, 'image' => 'images/products/jasmine-tea.jpg'],
                ['name' => 'Peach Tea',           'price' => 14000, 'stock' => 80],
                ['name' => 'Strawberry Tea',      'price' => 14000, 'stock' => 80],
                ['name' => 'Passion Fruit Tea',   'price' => 15000, 'stock' => 70, 'image' => 'images/products/passion-tea.jpg'],
                ['name' => 'Taro Tea',            'price' => 15000, 'stock' => 70],
            ],
            'YAKULT SERIES' => [
                ['name' => 'Yakult Original',     'price' => 14000, 'stock' => 80],
                ['name' => 'Yakult Lemon',        'price' => 15000, 'stock' => 80],
                ['name' => 'Yakult Strawberry',   'price' => 15000, 'stock' => 80],
                ['name' => 'Yakult Peach',        'price' => 15000, 'stock' => 70],
                ['name' => 'Yakult Mango',        'price' => 15000, 'stock' => 70],
                ['name' => 'Yakult Grape',        'price' => 15000, 'stock' => 70, 'image' => 'images/products/grape-tea.jpg'],
            ],
            'BLEND SERIES' => [
                ['name' => 'Thai Tea',            'price' => 16000, 'stock' => 80],
                ['name' => 'Matcha Latte',        'price' => 18000, 'stock' => 70, 'image' => 'images/products/matcha.jpg'],
                ['name' => 'Taro Latte',          'price' => 18000, 'stock' => 70],
                ['name' => 'Brown Sugar Milk Tea','price' => 18000, 'stock' => 70],
                ['name' => 'Wintermelon Milk Tea','price' => 18000, 'stock' => 60],
                ['name' => 'Cheese Tea',          'price' => 20000, 'stock' => 60],
                ['name' => 'Okinawa Milk Tea',    'price' => 18000, 'stock' => 60],
            ],
            'COFFEE SERIES' => [
                ['name' => 'Americano',           'price' => 15000, 'stock' => 80],
                ['name' => 'Latte',               'price' => 18000, 'stock' => 70],
                ['name' => 'Cappuccino',          'price' => 18000, 'stock' => 70],
                ['name' => 'Hazelnut Latte',      'price' => 20000, 'stock' => 60],
                ['name' => 'Caramel Latte',       'price' => 20000, 'stock' => 60],
                ['name' => 'Vietnam Drip',        'price' => 18000, 'stock' => 70],
                ['name' => 'Dalgona Coffee',      'price' => 20000, 'stock' => 60],
            ],
        ];

        foreach ($menu as $catName => $products) {
            $cat = Category::create([
                'name'        => $catName,
                'slug'        => Str::slug($catName),
                'description' => $catName . ' pilihan Donik Donuts',
                'is_active'   => true,
            ]);

            foreach ($products as $p) {
                Product::create([
                    'category_id'  => $cat->id,
                    'name'         => $p['name'],
                    'slug'         => Str::slug($p['name']) . '-' . time() . rand(1, 9999),
                    'price'        => $p['price'],
                    'stock'        => $p['stock'],
                    'image'        => $p['image'] ?? null,
=======
            ['name' => 'Coklat Kacang', 'price' => 10000],
            ['name' => 'Coklat Ceres Warna-warni', 'price' => 10000],
            ['name' => 'Vanilla Keju', 'price' => 10000],
            ['name' => 'Strawberry Keju', 'price' => 10000],
            ['name' => 'Vanilla Sprinkle', 'price' => 9000],
            ['name' => 'Matcha', 'price' => 10000],
            ['name' => 'Taro Ceres', 'price' => 10000],
            ['name' => 'Coklat Keju', 'price' => 10000],
            ['name' => 'Vanilla Oreo', 'price' => 10000],
            ['name' => 'Tiramisu Keju', 'price' => 12000],
            ['name' => 'Vanilla', 'price' => 8000],
            ['name' => 'Red Velvet', 'price' => 12000],
        ];

        foreach ($menu as $item) {
            $product = Product::firstOrCreate(
                [
                    'category_id' => $category->id,
                    'name' => $item['name'],
                ],
                [
                    'slug' => Str::slug('donuts-dunki-'.$item['name']),
                    'description' => $item['name'].' Donuts Dunki',
                    'price' => $item['price'],
                    'stock' => 10,
>>>>>>> 1f499fa (Update menu Donuts Dunki dan POS)
                    'is_available' => true,
                ]
            );

            if (! $product->is_available) {
                $product->update(['is_available' => true]);
            }
        }
    }
}
