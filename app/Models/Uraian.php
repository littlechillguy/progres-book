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
    'tanggal_selesai',
    'progres',
    'pic',
    'lampiran',
    'lampiran_nama',
    'lampiran_tipe',
    'keterangan',
];

    /**
     * Relasi ke tabel pelatihans
     */
    public function pelatihan(): BelongsTo
    {
        return $this->belongsTo(Pelatihan::class);
    }

    /**
     * Mengecek apakah lampiran berupa gambar
     */
    public function isImage(): bool
    {
        return in_array($this->lampiran_tipe, [
            'jpg',
            'jpeg',
            'png',
            'gif',
            'webp',
        ]);
    }

    /**
     * Mengecek apakah lampiran berupa PDF
     */
    public function isPdf(): bool
    {
        return $this->lampiran_tipe === 'pdf';
    }

    /**
     * Mengembalikan icon Font Awesome sesuai tipe file
     */
    public function fileIcon(): string
    {
        return match ($this->lampiran_tipe) {

            'pdf' => 'fa-file-pdf',

            'doc',
            'docx' => 'fa-file-word',

            'xls',
            'xlsx' => 'fa-file-excel',

            'ppt',
            'pptx' => 'fa-file-powerpoint',

            'jpg',
            'jpeg',
            'png',
            'gif',
            'webp' => 'fa-file-image',

            default => 'fa-file',
        };
    }
}