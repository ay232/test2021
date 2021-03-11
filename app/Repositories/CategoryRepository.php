<?php

namespace App\Repositories;


use App\Models\Category;
use Illuminate\Validation\Rule;

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $model = null)
    {
        if (!$model) {
            $model = new Category();
        }
        parent::__construct($model);

    }

    public function getValidationRules()
    {
        return [
            'id' => ['integer', 'exists:products,id',
                     Rule::requiredIf(\Request::method() != "POST" and \Request::method() != "GET")],
            'title' => ['string', 'between:3,12', Rule::requiredIf(\Request::method() == "POST")],
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