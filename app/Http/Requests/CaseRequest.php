<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CaseRequest extends FormRequest
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
            // 'case_name'        => ['required', 'string', 'max:255'],
            'case_type'        => ['required', 'string', 'max:255'],
            'target_category'  => ['required', 'string', 'max:255'],
            'case_priority'    => ['required', 'string', 'max:255'],
            // 'case_fee'         => ['required', 'numeric'],
            // 'task'             => ['required', 'string'],
            // 'flag'             => ['required'],
            'case_location'    => ['required', 'string', 'max:255'],
            // 'start_date'       => ['required', 'string'],
            // 'end_date'         => ['required', 'string', 'after_or_equal:start_date'],
            // 'status'           => ['required', 'string'],
            'company_id'       => ['required', 'exists:companies,id'],
            'brand_id'         => ['required', 'exists:brands,id'],
            'product_id'       => ['required', 'exists:products,id'],
            // 'description'      => ['required', 'string'],
            // 'document'       => ['required'],
        ];

    }
}
