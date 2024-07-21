<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JenisSuratStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user() != null
            && auth()->user()->hasRole('ADMIN');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'icon' => 'required|file|mimes:png,jpg,jpeg|max:2048',
            'file' => 'required|file|mimes:doc,docx,pdf|max:2048',
            'deskripsi' => 'nullable|string',
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
            'nama.required' => 'Nama surat wajib diisi',
            'nama.string' => 'Nama surat harus berupa string',
            'nama.max' => 'Nama surat maksimal 255 karakter',

            'icon.required' => 'Icon surat wajib diisi',
            'icon.file' => 'Icon surat harus berupa file',
            'icon.mimes' => 'Icon surat harus berupa file dengan ekstensi png, jpg, atau jpeg',
            'icon.max' => 'Icon surat maksimal 2MB',

            'file.required' => 'File surat wajib diisi',
            'file.file' => 'File surat harus berupa file',
            'file.mimes' => 'File surat harus berupa file dengan ekstensi doc, docx, atau pdf',
            'file.max' => 'File surat maksimal 2MB',

            'deskripsi.string' => 'Deskripsi surat harus berupa string',
        ];
    }
}
