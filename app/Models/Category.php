<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug', 
        'description',
        'image',
    ];
     // ✅ Many-to-Many with Product
    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }
     // ✅ One-to-Many with SubCategory
    public function subcategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }
}
