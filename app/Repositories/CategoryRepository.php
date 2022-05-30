<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Request;

class CategoryRepository extends BaseRepository
{
    /**
     * CategoryRepository constructor.
     * @param Category|null $model
     */
    public function __construct(Category $model = null)
    {
        if (! $model) {
            $model = new Category();
        }
        parent::__construct($model);
    }

    /**
     * @param $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getJustCreatedModel($data)
    {
        $category = app(Category::class);

        return $category->params($data)->orderByDesc('id')->first();
    }

    /**
     * @return array
     */
    public function getValidationRules(): array
    {
        $httpMethod = Request::method();
        $isNotPostAndGetMethod = ! in_array($httpMethod, ['POST', 'GET']);

        return [
            'id'    => ['integer',
                        'exists:products,id',
                        Rule::requiredIf($isNotPostAndGetMethod)],
            'title' => ['string',
                        'between:3,12',
                        Rule::requiredIf($httpMethod === "POST")],
            'eld'   => ['integer',
                        'nullable'],
        ];
    }

    /**
     * Possible to move messages in language file, but in task it was not important
     * @return array
     */
    public function getValidationMessages(): array
    {
        return [
            'max'      => 'Параметр :attribute должен быть не длиннее :max символов',
            'required' => 'Параметр :attribute обязателен для заполнения',
            'between'  => 'Параметр :attribute должен быть в диапазоне между :min и :max',
            'numeric'  => 'Параметр :attribute должен быть числом',
            'integer'  => 'Параметр :attribute должен быть целым числом',
            'exists'   => 'Параметр :attribute не существует',
        ];
    }
}