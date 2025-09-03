<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'description', 'image', 'category_id'];
protected $table = 'sub_categories';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
