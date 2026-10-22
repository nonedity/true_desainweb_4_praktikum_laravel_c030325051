<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Matakuliah extends Model
{
    protected $fillable = ['kode_mk', 'nama_mk', 'sks', 'semester', 'dosen_id'];

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }

    public function nilai(): HasMany
    {
        return $this->hasMany(NilaiMatakuliah::class);
    }
}