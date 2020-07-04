<?php

namespace App\Model;

use App\Model\Review;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'name', 'discount', 'detail', 'price', 'stock'
    ];  

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
