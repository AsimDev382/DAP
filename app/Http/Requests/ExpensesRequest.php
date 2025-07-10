<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpensesRequest extends FormRequest
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
            'auto_id'         => 'nullable|string|max:255',
            'client_id'       => 'nullable|string|max:255',
            // 'case_id'       => 'required|string|max:255',
            'case_type'       => 'required|string|max:255',
            'target_category' => 'required|string|max:255',
            'case_priority'   => 'required|string|max:100',
            'advance_fee'     => 'required|numeric',
            'case_expense'    => 'required|string',
            'total_amount'    => 'required|numeric',
            'case_location'   => 'required|string|max:255',
            'start_date'      => 'required|date',
            'end_date'        => 'required|date|after_or_equal:start_date',
            'status'          => 'required|string|max:100',
            'desbursement'    => 'nullable|in:Active,Inactive',

            'case_id'      => 'required|exists:case_managements,id',
            'company_id'      => 'required|exists:companies,id',
            'brand_id'        => 'required|exists:brands,id',
            'product_id'      => 'required|exists:products,id',
            'currency_id'     => 'required|exists:currencies,id',
            // 'user_id'         => 'nullable|exists:users,id',
        ];
    }
}
