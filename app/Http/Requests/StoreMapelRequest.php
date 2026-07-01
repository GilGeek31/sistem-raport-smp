<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class StoreMapelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //default false
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'kode_mapel' => 'required|string|max:10|unique:mapels, kode_mapel',
            'nama_mapel' => 'required|string|max:1000',
            'kategori' => 'required|in:umum,peminatan,mulok',

        ];
    }

    public function messages(): array
    {
        return [
            'kode_mapel.required' => 'Kode Mapel wajib diisi.',
            'kode_mapel.unique' => 'Kode Mapel ini sudah dipakai.',
            'nama_mapel.required' => 'Nama Mapel wajib diisi.',
            'kategori.in' => 'Kategori harus salah satu dari: umum, peminatan, mulok.',
        ];
    }
}
