<?php

namespace App\Support;

class PrototypeData
{
    public static function categories(): array
    {
        return [
            ['name' => 'Fruits & Vegetables', 'slug' => 'fruits-vegetables', 'icon' => 'fa-carrot'],
            ['name' => 'Dairy & Eggs', 'slug' => 'dairy-eggs', 'icon' => 'fa-egg'],
            ['name' => 'Meat & Poultry', 'slug' => 'meat-poultry', 'icon' => 'fa-drumstick-bite'],
            ['name' => 'Beverages', 'slug' => 'beverages', 'icon' => 'fa-mug-hot'],
            ['name' => 'Household', 'slug' => 'household', 'icon' => 'fa-spray-can-sparkles'],
            ['name' => 'Pantry', 'slug' => 'pantry', 'icon' => 'fa-box-open'],
        ];
    }

    public static function products(): array
    {
        return [
            ['name' => 'Fresh Roma Tomatoes', 'slug' => 'fresh-roma-tomatoes', 'category' => 'Fruits & Vegetables', 'category_slug' => 'fruits-vegetables', 'price' => 2500, 'old_price' => 3000, 'unit' => '1kg', 'badge' => 'Fresh Deal', 'featured' => true, 'image' => 'https://images.unsplash.com/photo-1550989460-0adf9ea622e2?auto=format&fit=crop&q=80&w=600'],
            ['name' => 'Basmati Premium Rice', 'slug' => 'basmati-premium-rice', 'category' => 'Pantry', 'category_slug' => 'pantry', 'price' => 12500, 'old_price' => null, 'unit' => '5kg', 'badge' => 'Best Seller', 'featured' => true, 'image' => 'https://images.unsplash.com/photo-1523472721958-978152f4d69b?auto=format&fit=crop&q=80&w=600'],
            ['name' => 'Large Abuja Sweet Yam', 'slug' => 'large-abuja-sweet-yam', 'category' => 'Fruits & Vegetables', 'category_slug' => 'fruits-vegetables', 'price' => 4500, 'old_price' => null, 'unit' => 'tuber', 'badge' => 'Market Pick', 'featured' => true, 'image' => 'https://images.unsplash.com/photo-1571771894821-ce9b6c11b08e?auto=format&fit=crop&q=80&w=600'],
            ['name' => 'Vegetable Cooking Oil', 'slug' => 'vegetable-cooking-oil', 'category' => 'Pantry', 'category_slug' => 'pantry', 'price' => 8900, 'old_price' => null, 'unit' => '3L', 'badge' => 'Restocked', 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?auto=format&fit=crop&q=80&w=600'],
            ['name' => 'Golden Penny Spaghetti', 'slug' => 'golden-penny-spaghetti', 'category' => 'Pantry', 'category_slug' => 'pantry', 'price' => 950, 'old_price' => null, 'unit' => '500g', 'badge' => 'Quick Meal', 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1551462147-ff29053bfc14?auto=format&fit=crop&q=80&w=600'],
            ['name' => 'Frozen Whole Chicken', 'slug' => 'frozen-whole-chicken', 'category' => 'Meat & Poultry', 'category_slug' => 'meat-poultry', 'price' => 7500, 'old_price' => null, 'unit' => '2kg', 'badge' => 'Frozen', 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1604503468506-a8da13d82791?auto=format&fit=crop&q=80&w=600'],
            ['name' => 'Fresh Whole Milk', 'slug' => 'fresh-whole-milk', 'category' => 'Dairy & Eggs', 'category_slug' => 'dairy-eggs', 'price' => 1800, 'old_price' => null, 'unit' => '1L', 'badge' => 'Chilled', 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1550583724-125581cc2586?auto=format&fit=crop&q=80&w=600'],
            ['name' => 'Brown Crate Eggs', 'slug' => 'brown-crate-eggs', 'category' => 'Dairy & Eggs', 'category_slug' => 'dairy-eggs', 'price' => 3600, 'old_price' => 4000, 'unit' => '30 pcs', 'badge' => 'Farm Fresh', 'featured' => true, 'image' => 'https://images.unsplash.com/photo-1608667508764-33cf0726b13a?auto=format&fit=crop&q=80&w=600'],
            ['name' => 'Chivita Orange Juice', 'slug' => 'chivita-orange-juice', 'category' => 'Beverages', 'category_slug' => 'beverages', 'price' => 1100, 'old_price' => null, 'unit' => '1L', 'badge' => 'Cold Drink', 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1621506289937-a8e4df240d0b?auto=format&fit=crop&q=80&w=600'],
            ['name' => 'Ariel Detergent Powder', 'slug' => 'ariel-detergent-powder', 'category' => 'Household', 'category_slug' => 'household', 'price' => 3800, 'old_price' => null, 'unit' => '1kg', 'badge' => 'Household', 'featured' => false, 'image' => 'https://images.unsplash.com/photo-1607006342456-ba275cd34840?auto=format&fit=crop&q=80&w=600'],
        ];
    }

    public static function subscriptions(): array
    {
        return [
            ['name' => 'Starter Basket', 'price' => 25000, 'saving' => 3500, 'frequency' => 'Monthly', 'features' => ['Fresh vegetables', 'Pantry essentials', 'Up to 8 customizable items']],
            ['name' => 'Family Basket', 'price' => 70000, 'saving' => 12000, 'frequency' => 'Monthly', 'features' => ['Weekly fresh produce', 'Proteins and dairy', 'Up to 20 customizable items']],
            ['name' => 'Premium Basket', 'price' => 150000, 'saving' => 30000, 'frequency' => 'Monthly', 'features' => ['Premium groceries', 'Priority delivery', 'Dedicated support line']],
        ];
    }

    public static function orders(): array
    {
        return [
            ['number' => 'ORD-2026-0182', 'date' => 'June 18, 2026', 'items' => 3, 'total' => 22900, 'status' => 'processing'],
            ['number' => 'ORD-2026-0174', 'date' => 'June 12, 2026', 'items' => 8, 'total' => 45500, 'status' => 'completed'],
            ['number' => 'ORD-2026-0168', 'date' => 'June 8, 2026', 'items' => 2, 'total' => 8400, 'status' => 'pending'],
        ];
    }

    public static function adminMetrics(): array
    {
        return [
            ['label' => 'Gross Sales Revenue', 'value' => '₦2,850,400', 'icon' => 'fa-wallet', 'tone' => 'emerald'],
            ['label' => 'Fulfillment Volume', 'value' => '142 Orders', 'icon' => 'fa-truck-fast', 'tone' => 'blue'],
            ['label' => 'Active Food Baskets', 'value' => '428 Plans', 'icon' => 'fa-basket-shopping', 'tone' => 'purple'],
            ['label' => 'Low Stock Alerts', 'value' => '16 SKUs', 'icon' => 'fa-triangle-exclamation', 'tone' => 'orange'],
        ];
    }

    public static function customers(): array
    {
        return [
            ['name' => 'Tunde Faro', 'email' => 'tunde@faro.com', 'phone' => '+234 803 123 4567', 'orders' => 14, 'spent' => 240500],
            ['name' => 'Chioma Okafor', 'email' => 'chioma@mail.com', 'phone' => '+234 701 555 1090', 'orders' => 9, 'spent' => 185000],
            ['name' => 'Bose Adebayo', 'email' => 'bose@web.com', 'phone' => '+234 902 810 4455', 'orders' => 4, 'spent' => 62100],
        ];
    }

    public static function money(int|float $amount): string
    {
        return '₦'.number_format($amount);
    }
}
