<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_categories'; // must be plural with underscore

    protected $fillable = ['name', 'slug', 'description', 'image', 'category_id'];

   // ✅ SubCategory belongs to Category (still true)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // ✅ Many-to-Many with Product
  public function products()
{
    return $this->belongsToMany(
        Product::class,
        'product_subcategory',
        'subcategory_id',
        'product_id'
    );
}
}
