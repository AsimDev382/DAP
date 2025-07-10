<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RaidPlainingRequest extends FormRequest
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
            'raid_type' => ['required', 'string', 'max:255'],
            'date' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'department_id' => ['required'],
            'sub_department_id' => ['required'],
            'company_id' => ['required'],
            'brand_id' => ['required'],
            'product_id' => ['required'],
            'group_id' => ['required'],
        ];
    }
}
