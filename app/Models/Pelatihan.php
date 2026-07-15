<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelatihan extends Model
{
    protected $table = 'pelatihans';
    protected $fillable = ['nama_pelatihan', 'tahapan', 'kegiatan', 'hari', 'tanggal', 'tempat'];

    public function uraians(): HasMany
    {
        return $this->hasMany(Uraian::class, 'pelatihan_id');
    }
}