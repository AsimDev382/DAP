<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->route('id')),
            ],
            // 'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user)],
            'user_phone' => ['required', 'string'],
            'designation' => ['required', 'string'],
            'designation' => ['required', 'string'],
            'sub_department' => ['required', 'string'],
            'department' => ['required', 'string'],
            'company_id' => ['required', 'string'],
            'user_location' => ['required', 'string'],
            'user_address' => ['required', 'string'],
            'password' => ['required', 'confirmed'],
            // 'user_img' => ['required', 'string'],
        ];
    }
}
