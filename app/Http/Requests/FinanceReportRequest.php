<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinanceReportRequest extends FormRequest
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
            'auto_id'               => 'nullable',
            'raid_type'             => 'required|string|max:255',
            'document'              => 'nullable',
            'date'                  => 'required|date',
            'location'              => 'required|string',
            'expenses'              => 'required|numeric',
            'profit'                => 'required|numeric',
            'status'                => 'required|string|max:100',
            'description'           => 'nullable',

            'company_id'            => 'required|exists:companies,id',
            'brand_id'              => 'required|exists:brands,id',
            'product_id'            => 'required|exists:products,id',
            'department_id'         => 'required|exists:departments,id',
            'sub_department_id'     => 'required|exists:sub_departments,id',
            'group_id'              => 'required|exists:groups,id',
        ];
    }
}
