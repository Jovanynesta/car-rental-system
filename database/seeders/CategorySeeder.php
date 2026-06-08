<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'SUV', 'description' => 'Véhicules spacieux et confortables'],
            ['name' => 'Berline', 'description' => 'Voitures élégantes pour la ville et les longs trajets'],
            ['name' => 'Compacte', 'description' => 'Voitures économiques et faciles à conduire'],
            ['name' => '4x4', 'description' => 'Véhicules tout-terrain'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
