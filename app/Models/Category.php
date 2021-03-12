<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;

/**
 * Class Category
 * @package App\Models
 */
class Category extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['title', 'eId'];

    /**
     * @return BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * @param $query
     * @param $array
     * @return mixed
     */
    public function scopeParams(Builder $query, $array)
    {
        $array = Arr::only($array, $this->fillable);
        foreach ($array as $key => $value) {
            $query = $query->where($key, $value);
        }
        return $query;
    }
}
