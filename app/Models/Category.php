<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
    ];

    //親カテゴリーを取得
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    //子カテゴリーを取得
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_categories', 'category_id', 'item_id');
    }
}
