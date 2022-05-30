<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryProduct extends Pivot
{
    /**
     * @var array
     */
    protected $guarded = [];
    /**
     * @var bool
     */
    protected $fillable = ['category_id', 'product_id'];
    /**
     * @var bool
     */
    public $timestamps = false;
}
