<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SuratMasukRequest extends FormRequest
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
            'file' => 'required|file|mimes:doc,docx,pdf|max:2048',
            'jenis_surat_id' => 'required',
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
            'file.required' => 'File surat wajib diisi',
            'file.file' => 'File surat harus berupa file',
            'file.mimes' => 'File surat harus berupa file dengan ekstensi doc, docx, atau pdf',
            'file.max' => 'File surat maksimal 2MB',

            'jenis_surat_id.required' => 'Jenis surat wajib diisi',
        ];
    }
}
