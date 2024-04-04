<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'material',
        'color',
        'size',
        'category',
        'image_url',
    ];

    public function shops()
    {
        return $this->belongsTo(Shop::class,'shop_id');
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'product_orders');
    }

}
