<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentStoreRequest extends FormRequest
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
            'name' => 'required|min:3|max:20',
            'age' => 'required|integer',
            'gender' => 'required',
        ];
    }
    
    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => ':attribute is required.',
            'min' => ':attribute should be between 3-20 characters',
            'max' => ':attribute should be between 3-20 characters',
            'integer' => ':attribute is integer',
        ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            'name' => 'trim|capitalize|escape'
        ];
    }
}
