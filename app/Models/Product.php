<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['lender_id', 'name', 'summary', 'image', 'categorie'];

    protected $table = 'products';

    public function pictures()
    {
        return $this->hasMany(ProductPicture::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'lender_id');
    }

    public function lendings()
    {
        return $this->hasMany(Lending::class);
    }
}
