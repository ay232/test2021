<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models
 */
class Product extends Model
{
    protected $fillable=['title','price','eld'];


    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
