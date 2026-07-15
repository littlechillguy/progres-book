<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Uraian extends Model
{
    protected $fillable = [
        'pelatihan_id',
        'urutan',
        'uraian_kegiatan',
        'tanggal',
        'progres',
        'pic',
        'link',
        'keterangan',
    ];

    public function pelatihan(): BelongsTo
    {
        return $this->belongsTo(Pelatihan::class);
    }
}