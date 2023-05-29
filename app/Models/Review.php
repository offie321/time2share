<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['lending_id', 'reviewer_id', 'rating', 'comment'];

    protected $table = 'reviews';

    public function lending()
    {
        return $this->belongsTo(Lending::class, 'lending_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }
}
