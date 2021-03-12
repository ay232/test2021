<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

/**
 * Class Product
 * @package App\Models
 */
class Product extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['title', 'price', 'eId'];
//    protected $dispatchesEvents = []

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopeParams(Builder $query, $array)
    {
        $array = Arr::only($array, $this->fillable);
        foreach ($array as $key => $value) {
            $query = $query->where($key, $value);
        }
        return $query;
    }
}
