<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    use Crudable;


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->get('id', null) ? "," . $this->get('id', null) : "";
        return [
            'id' => ['integer', 'exists:products,id', Rule::requiredIf($this->method != "POST")],
            'title' => ['string', 'max:12'],
            'price' => ['numeric', 'between:0,200'],
            'eld' => ['integer', 'nullable'],
        ];
    }

    /**
     * @return array|void
     */
    public function messages()
    {
        return [
            'max' => 'Параметр :attribute должен быть не длиннее :max символов',
            'required' => 'Параметр :attribute обязателен для заполнения',
            'between' => 'Параметр :attribute должен быть в диапазоне между :min :max',
            'numeric' => 'Параметр :attribute должен быть числом',
            'integer' => 'Параметр :attribute должен быть целым числом',
            'exists' => 'Параметр :attribute не существует',
        ];

    }
}
