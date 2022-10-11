<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_name' => [
                'required', 'string'
            ],

            'description' => [
                'required', 'string'
            ],

            'severity' => [
                'required', 'string', Rule::in(['low', 'medium', 'high'])
            ],

            'links' => [
                'required', 'array', 'min:1'
            ],

            'links.*' => [
                'required', 'url'
            ]
        ];
    }
}
