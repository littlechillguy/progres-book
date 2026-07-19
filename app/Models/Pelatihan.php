<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelatihan extends Model
{
    protected $fillable = [

    'nama_pelatihan',
    'tahapan',
    'kegiatan',
    'hari',
    'tanggal',
    'tempat',
    'favorit',

];

    public function uraians(): HasMany
    {
        return $this->hasMany(Uraian::class)->orderBy('urutan');
    }

     // ==========================
    // Helper Lampiran
    // ==========================

    public function isImage()
    {
        return in_array(strtolower($this->lampiran_tipe), [
            'jpg',
            'jpeg',
            'png',
            'gif',
            'webp'
        ]);
    }

    public function isPdf()
    {
        return strtolower($this->lampiran_tipe) === 'pdf';
    }

    public function fileIcon()
    {
        return match (strtolower($this->lampiran_tipe)) {

            'pdf' => 'fa-file-pdf',

            'doc',
            'docx' => 'fa-file-word',

            'xls',
            'xlsx' => 'fa-file-excel',

            'ppt',
            'pptx' => 'fa-file-powerpoint',

            'zip',
            'rar' => 'fa-file-zipper',

            default => 'fa-file',
        };
    }
}
