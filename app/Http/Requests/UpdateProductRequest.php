<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'=>['required','min:5','max:30','string'],
            'description'=>['required','min:15','string'],
            'price'=>['required','numeric','between: 1,99999'],
            'quantity'=>['required','integer','between:1,999'],
            'pharmacies'=>['required'],
            'image'=>['nullable','max:1000','mimes:jpg,jpeg,png'],
            'pharmacies.*' => 'exists:pharmacies,id',
        ];
    }
}
