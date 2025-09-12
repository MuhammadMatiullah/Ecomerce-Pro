<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'discount',
        'quantity',
        'size',
        'color',
        'description',
        'image',
        'status',
    ];

   
    // ✅ Many-to-Many with Category
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    // ✅ Many-to-Many with SubCategory
   public function subcategories()
{
    return $this->belongsToMany(
        SubCategory::class,
        'product_subcategory',   // pivot table
        'product_id',            // foreign key for Product
        'subcategory_id'         // foreign key for SubCategory
    );
}
}
