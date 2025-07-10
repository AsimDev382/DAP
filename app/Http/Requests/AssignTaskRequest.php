<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignTaskRequest extends FormRequest
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
            // 'auto_id' => ['required', 'string', 'max:255'],
            'assign_date' => ['required'],
            'expiry_date' => ['required', 'string', 'after_or_equal:assign_date'],
            'location' => ['required', 'string', 'max:255'],
            'task_id' => ['required'],
            'department_id' => ['required'],
            'group_name' => ['required'],
            'group_member' => ['required'],
            // 'document' => ['nullable'],
        ];
    }
}
