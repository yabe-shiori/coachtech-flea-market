<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'category_id',
        'brand_id',
        'price',
        'condition',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function itemImages()
    {
        return $this->hasMany(ItemImage::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
