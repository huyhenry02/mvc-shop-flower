<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/data/products.json'));
        $data = json_decode($json);

        foreach ($data as $item) {
            Product::create([
                'code' => $item->code,
                'category_id' => $item->category_id,
                'name' => $item->name,
                'description' => $item->description,
                'price' => $item->price,
                'detail_image' => '/shop/img/single-item.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
