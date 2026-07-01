<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    public function run(): void
    {
        $subscriptions = [
            [
                'name' => 'Starter Basket',
                'description' => 'Perfect for individuals and small households',
                'price' => 25000,
                'savings_amount' => 3500,
                'delivery_frequency' => 'Monthly',
                'customizable_limit' => 8,
                'features' => ['Fresh vegetables', 'Pantry essentials', 'Up to 8 customizable items'],
            ],
            [
                'name' => 'Family Basket',
                'description' => 'Ideal for growing families',
                'price' => 70000,
                'savings_amount' => 12000,
                'delivery_frequency' => 'Monthly',
                'customizable_limit' => 20,
                'features' => ['Weekly fresh produce', 'Proteins and dairy', 'Up to 20 customizable items'],
            ],
            [
                'name' => 'Premium Basket',
                'description' => 'For the discerning customer who wants the best',
                'price' => 150000,
                'savings_amount' => 30000,
                'delivery_frequency' => 'Monthly',
                'customizable_limit' => 50,
                'features' => ['Premium groceries', 'Priority delivery', 'Dedicated support line'],
            ],
        ];

        foreach ($subscriptions as $subscription) {
            Subscription::create($subscription);
        }
    }
}
