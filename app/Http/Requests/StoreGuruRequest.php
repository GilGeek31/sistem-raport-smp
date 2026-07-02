<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class StoreGuruRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $guru = $this->route('guru');

        return [
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,',
            'nip' => 'nullable|string|max:20|unique:gurus,nip,',
            'nuptk' => 'nullable|string|max:20|unique:gurus,nuptk',
            'no_hp' => 'nullable|string|max:15',
            'password' => 'required|string|min:8|confirmed',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama guru wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'nip.unique' => 'NIP ini sudah terdaftar.',
            'nuptk.unique' => 'NUPTK ini sudah terdaftar.',
            'password.min' => 'Password minimal 8 karakter,',
            'password.required' => 'Password harus diisi',
            'password.confirmed' => 'Password tidak cocok.',
            'foto_profil.image' => 'File harus berupa gambar.',
            'foto_profil.max' => 'Ukuran foto maksimal 2MB.'
        ];
    }
}
