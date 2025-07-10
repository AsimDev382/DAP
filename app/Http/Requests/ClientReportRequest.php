<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientReportRequest extends FormRequest
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
            // 'auto_id'         => 'nullable|string|max:255',
            // 'client_id'         => 'nullable|numeric',
            // 'client_name'         => 'nullable|string|max:255',
            'raid_type'       => 'required|string|max:255',
            'document'        => 'nullable',
            'total_amount'            => 'required|numeric',
            'payed_amount'            => 'required|numeric',
            'balance'            => 'required|numeric',
            'date'            => 'required|date',
            'status'          => 'required|string|max:100',
            'location'        => 'required|string',
            'description'     => 'nullable',

            'user_id'      => 'nullable|exists:users,id',
            // 'case_id'      => 'nullable|exists:case_managements,id',
            'company_id'      => 'required|exists:companies,id',
            'brand_id'        => 'required|exists:brands,id',
            'product_id'      => 'required|exists:products,id',
            'department_id'         => 'required|exists:departments,id',
            'sub_department_id'         => 'required|exists:sub_departments,id',
            'group_id'     => 'required|exists:groups,id',
        ];
    }
}
