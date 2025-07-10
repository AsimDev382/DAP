<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvestigationRequest extends FormRequest
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
            'case_id'                    => ['required', 'string', 'max:255'],
            'invest_name'                => ['required', 'string', 'max:255'],
            'case_type'                  => ['required', 'string', 'max:255'],
            'company_id'                 => ['required'],
            'brand_id'                   => ['required'],
            'product_id'                 => ['required'],
            'current_status'             => ['required', 'string', 'max:255'],
            'location'                   => ['required', 'string', 'max:255'],
            'user_id'                => ['required'],
            'task_start_date'            => ['required'],
            'task_deadline'              => ['required', 'after_or_equal:task_start_date'],
            // 'document'              => ['required'],
        ];
    }
}
