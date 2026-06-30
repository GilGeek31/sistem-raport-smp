<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nilai extends Model
{
    protected $fillable = [
        'siswa_id',
        'mapel_id',
        'kelas_id',
        'tahun_ajaran_id',
        'nilai_akhir',
        'deskripsi',
        'created_by',
    ];

    protected $casts = [
        'nilai_akhir' => 'decimal:2',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    public function mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class);
    }

    public function tahunAjaran(): BelongsTo
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function guruPenginput(): BelongsTo
    {
        return $this->belongsTo(Guru::class, 'created_by');
    }
}
