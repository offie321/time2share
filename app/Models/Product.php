<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['lender_id', 'name', 'summary', 'categories'];

    protected $table = 'products';

    public function pictures()
    {
        return $this->hasMany(ProductPicture::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }
}
