<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_name'      => ['required', 'string', 'max:255'],
            'company_id'        => ['required', 'exists:companies,id'],
            'brand_id'          => ['required', 'exists:brands,id'],
            'product_category'  => ['required', 'string', 'max:255'],
            // 'trademark_date'    => ['required', 'string'],
            // 'patient_date'      => ['required', 'string'],
            // 'copyright_date'    => ['required', 'string'],
            // 'product_img'    => ['required', 'string'],
        ];
    }
}
