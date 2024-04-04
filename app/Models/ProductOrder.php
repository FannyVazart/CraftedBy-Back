<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory, HasUuids;

    public function products()
    {
        return $this->belongsToMany(Product::class,'product_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class,'order_id');
    }

}
