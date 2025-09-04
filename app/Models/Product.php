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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
{
    return $this->belongsTo(Subcategory::class, 'subcategory_id');
}
}
