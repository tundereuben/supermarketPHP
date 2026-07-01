<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    protected $fillable = ['name', 'description', 'price', 'savings_amount', 'delivery_frequency', 'customizable_limit', 'features'];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'savings_amount' => 'decimal:2',
            'features' => 'json',
        ];
    }

    public function userSubscriptions(): HasMany
    {
        return $this->hasMany(UserSubscription::class);
    }
}
