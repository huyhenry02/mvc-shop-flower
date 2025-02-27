<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('seeders/data/categories.csv');
        $csvData = array_map('str_getcsv', file($path));
        $categories = [];
        foreach ($csvData as $row) {
            $categories[] = [
                'id' => $row[0],
                'name' => $row[1],
                'description' => $row[2],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('categories')->insert($categories);
    }
}
