<?php

namespace App\Repositories;


use App\Models\Product;
use Illuminate\Validation\Rule;

class ProductRepository extends BaseRepository
{
    public function __construct(Product $model = null)
    {
        if (!$model) {
            $model = new Product();
        }
        parent::__construct($model);

    }

    public function getValidationRules()
    {
        return [
            'id' => ['integer', 'exists:products,id',
                     Rule::requiredIf(\Request::method() != "POST" and \Request::method() != "GET")],
            'title' => ['string', 'between:3,12', Rule::requiredIf(\Request::method() == "POST")],
            'price' => ['numeric', 'between:0,200'],
            'eld' => ['integer', 'nullable'],
        ];
    }

    public function getValidationMessages()
    {
        return [
            'max' => 'Параметр :attribute должен быть не длиннее :max символов',
            'required' => 'Параметр :attribute обязателен для заполнения',
            'between' => 'Параметр :attribute должен быть в диапазоне между :min и :max',
            'numeric' => 'Параметр :attribute должен быть числом',
            'integer' => 'Параметр :attribute должен быть целым числом',
            'exists' => 'Параметр :attribute не существует',
        ];
    }
}