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
        return $this->belongsToMany(Category::class, 'item_categories');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
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

    // 商品名で検索
    public function scopeSearchByName($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }

    // カテゴ検索
    public function scopeSearchByCategory($query, $categoryName)
    {
        return $query->whereHas('category', function ($query) use ($categoryName) {
            $query->where('name', 'like', '%' . $categoryName . '%');
        });
    }

    // ブランド検索
    public function scopeSearchByBrand($query, $brandName)
    {
        return $query->whereHas('brand', function ($query) use ($brandName) {
            $query->where('name', 'like', '%' . $brandName . '%');
        });
    }
}
