<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // 👇 Allowed fields for mass assignment
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'subcategory_id',
        'price',
        'discount',
        'quantity',
        'size',
        'color',
        'description',
        'image',
        'status',
    ];

    // 👇 Relation with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // 👇 Relation with Subcategory
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
