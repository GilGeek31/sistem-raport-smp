<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMapelRequest extends FormRequest
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
        $mapelId = $this->route('mapel')->id;

        return [
            'kode_mapel' => 'required|string|max:10|unique:mapels,kode_mapel,' . $mapelId,
            'nama_mapel' => 'required|string|max:100',
            'kategori' => 'required|in:umum,peminatan,mulok',
        ];
    }
}
