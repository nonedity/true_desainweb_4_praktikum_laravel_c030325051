<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mahasiswa extends Model
{
    protected $fillable = ['nim', 'nama', 'email', 'prodi', 'semester'];

    // Satu mahasiswa punya banyak nilai
    public function nilai(): HasMany
    {
        return $this->hasMany(NilaiMatakuliah::class);
    }

    // Accessor: dipanggil sebagai $mahasiswa->status
    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->semester >= 7 ? 'Tingkat Akhir' : 'Aktif',
        );
    }
}