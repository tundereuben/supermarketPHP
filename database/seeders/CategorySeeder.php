<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Fruits & Vegetables', 'slug' => 'fruits-vegetables', 'icon' => 'fa-carrot'],
            ['name' => 'Dairy & Eggs', 'slug' => 'dairy-eggs', 'icon' => 'fa-egg'],
            ['name' => 'Meat & Poultry', 'slug' => 'meat-poultry', 'icon' => 'fa-drumstick-bite'],
            ['name' => 'Beverages', 'slug' => 'beverages', 'icon' => 'fa-mug-hot'],
            ['name' => 'Household', 'slug' => 'household', 'icon' => 'fa-spray-can-sparkles'],
            ['name' => 'Pantry', 'slug' => 'pantry', 'icon' => 'fa-box-open'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
