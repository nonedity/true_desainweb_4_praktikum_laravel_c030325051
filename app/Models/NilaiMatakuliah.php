<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NilaiMatakuliah extends Model
{
    protected $fillable = ['mahasiswa_id', 'matakuliah_id', 'nilai'];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function matakuliah(): BelongsTo
    {
        return $this->belongsTo(Matakuliah::class);
    }
}