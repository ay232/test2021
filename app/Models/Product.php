<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopeParams(Builder $query, array $array): Builder
    {
        $array = Arr::only($array, $this->fillable);
        foreach ($array as $key => $value) {
            $query = $query->where($key, $value);
        }

        return $query;
    }
}
