<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

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

}
