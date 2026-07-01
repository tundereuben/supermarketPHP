<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Fresh Roma Tomatoes', 'slug' => 'fresh-roma-tomatoes', 'category' => 'fruits-vegetables', 'price' => 2500, 'unit' => '1kg', 'is_featured' => true, 'image' => 'https://images.unsplash.com/photo-1550989460-0adf9ea622e2?auto=format&fit=crop&q=80&w=600', 'description' => 'Fresh organic Roma tomatoes'],
            ['name' => 'Basmati Premium Rice', 'slug' => 'basmati-premium-rice', 'category' => 'pantry', 'price' => 12500, 'unit' => '5kg', 'is_featured' => true, 'image' => 'https://images.unsplash.com/photo-1523472721958-978152f4d69b?auto=format&fit=crop&q=80&w=600', 'description' => 'Premium quality Basmati rice'],
            ['name' => 'Large Abuja Sweet Yam', 'slug' => 'large-abuja-sweet-yam', 'category' => 'fruits-vegetables', 'price' => 4500, 'unit' => 'tuber', 'is_featured' => true, 'image' => 'https://images.unsplash.com/photo-1571771894821-ce9b6c11b08e?auto=format&fit=crop&q=80&w=600', 'description' => 'Sweet Abuja yams'],
            ['name' => 'Vegetable Cooking Oil', 'slug' => 'vegetable-cooking-oil', 'category' => 'pantry', 'price' => 8900, 'unit' => '3L', 'is_featured' => false, 'image' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?auto=format&fit=crop&q=80&w=600', 'description' => 'Pure vegetable cooking oil'],
            ['name' => 'Golden Penny Spaghetti', 'slug' => 'golden-penny-spaghetti', 'category' => 'pantry', 'price' => 950, 'unit' => '500g', 'is_featured' => false, 'image' => 'https://images.unsplash.com/photo-1551462147-ff29053bfc14?auto=format&fit=crop&q=80&w=600', 'description' => 'Golden Penny pasta spaghetti'],
            ['name' => 'Frozen Whole Chicken', 'slug' => 'frozen-whole-chicken', 'category' => 'meat-poultry', 'price' => 7500, 'unit' => '2kg', 'is_featured' => false, 'image' => 'https://images.unsplash.com/photo-1604503468506-a8da13d82791?auto=format&fit=crop&q=80&w=600', 'description' => 'Frozen whole chicken'],
            ['name' => 'Fresh Whole Milk', 'slug' => 'fresh-whole-milk', 'category' => 'dairy-eggs', 'price' => 1800, 'unit' => '1L', 'is_featured' => false, 'image' => 'https://images.unsplash.com/photo-1550583724-125581cc2586?auto=format&fit=crop&q=80&w=600', 'description' => 'Fresh whole milk'],
            ['name' => 'Brown Crate Eggs', 'slug' => 'brown-crate-eggs', 'category' => 'dairy-eggs', 'price' => 3600, 'unit' => '30 pcs', 'is_featured' => true, 'image' => 'https://images.unsplash.com/photo-1608667508764-33cf0726b13a?auto=format&fit=crop&q=80&w=600', 'description' => 'Fresh brown eggs'],
            ['name' => 'Chivita Orange Juice', 'slug' => 'chivita-orange-juice', 'category' => 'beverages', 'price' => 1100, 'unit' => '1L', 'is_featured' => false, 'image' => 'https://images.unsplash.com/photo-1621506289937-a8e4df240d0b?auto=format&fit=crop&q=80&w=600', 'description' => 'Chivita orange juice'],
            ['name' => 'Ariel Detergent Powder', 'slug' => 'ariel-detergent-powder', 'category' => 'household', 'price' => 3800, 'unit' => '1kg', 'is_featured' => false, 'image' => 'https://images.unsplash.com/photo-1607006342456-ba275cd34840?auto=format&fit=crop&q=80&w=600', 'description' => 'Ariel detergent powder'],
        ];

        foreach ($products as $product) {
            $category = Category::where('slug', $product['category'])->first();
            if ($category) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $product['name'],
                    'slug' => $product['slug'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'unit' => $product['unit'],
                    'image_url' => $product['image'],
                    'stock' => 100,
                    'is_featured' => $product['is_featured'],
                ]);
            }
        }
    }
}
