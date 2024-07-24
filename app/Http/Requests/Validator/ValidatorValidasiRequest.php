<?php

namespace App\Http\Requests\Validator;

use Illuminate\Foundation\Http\FormRequest;

class ValidatorValidasiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user() != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'surat_masuk_id' => 'required',
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
            'surat_masuk_id.required' => 'ID Surat Masuk Tidak Boleh Kosong',
        ];
    }
}
