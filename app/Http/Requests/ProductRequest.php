<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['bail', 'required','min:10'],
            'article' => ['bail', 'required', 'unique:App\Models\Products,article', 'regex:/^[A-Za-z0-9]+$/']
        ];
    }

    public function passedValidation()
    {
        $this->merge([
            'data' => json_encode( $this->data )
        ]);
    }

}
