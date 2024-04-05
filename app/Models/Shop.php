<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'theme',
        'biography',
        'specialties',
        'location',
        'techniques',
        'image_url',
        'user_id'
    ];

    public function products()
    {
        return $this->hasMany(Product::class,'product_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }


}
