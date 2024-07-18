<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ChangeUserRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user() == null &&
            auth()->user()->hasRole('ADMIN');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|string|min:32|max:36',
            'role_id' => 'required|string|max:36',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'user_id.required' => 'ID User tidak boleh kosong',
            'user_id.string' => 'ID User tidak valid',
            'user_id.min' => 'ID User tidak valid',
            'user_id.max' => 'ID User tidak valid',

            'role_id.required' => 'ID Role tidak boleh kosong',
            'role_id.string' => 'ID Role tidak valid',
            'role_id.max' => 'ID Role tidak valid',
        ];
    }
}
