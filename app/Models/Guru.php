<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guru extends Model
{
    protected $fillable = [
        'user_id',
        'nip',
        'nuptk',
        'nama',
        'email',
        'no_hp',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kelasWali(): HasMany
    {
        return $this->hasMany(Kelas::class, 'wali_kelas_id');
    }

    public function guruMapels(): HasMany
    {
        return $this->hasMany(GuruMapel::class);
    }

    public function nilaiDiinput(): HasMany
    {
        return $this->hasMany(Nilai::class, 'created_by');
    }
}
