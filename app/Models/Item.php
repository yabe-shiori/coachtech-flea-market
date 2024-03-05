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
        'brand_id',
        'price',
        'condition',
        'description',
        'is_sold',
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
        return $this->belongsToMany(User::class, 'favorites', 'item_id', 'user_id')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // 商品名で検索
    public function scopeSearchByName($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }

    // カテゴリ検索
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

    //商品が売れたかどうかを判定
    public function isSold()
    {
        return $this->is_sold;
    }
}
