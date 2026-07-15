<?php

namespace Database\Seeders;

use App\Models\Pelatihan;
use App\Models\Uraian;
use Illuminate\Database\Seeder;

class PelatihanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            [
                'nama_pelatihan' => 'Pelatihan Laravel Fundamental',
                'tahapan' => 'Pelaksanaan',
                'kegiatan' => 'Pelatihan Backend',
                'hari' => 'Senin',
                'tanggal' => '2026-01-12',
                'tempat' => 'Jakarta'
            ],

            [
                'nama_pelatihan' => 'Pelatihan Cyber Security',
                'tahapan' => 'Persiapan',
                'kegiatan' => 'Workshop Keamanan Siber',
                'hari' => 'Selasa',
                'tanggal' => '2026-02-20',
                'tempat' => 'Bandung'
            ],

            [
                'nama_pelatihan' => 'Pelatihan UI/UX',
                'tahapan' => 'Evaluasi',
                'kegiatan' => 'Pelatihan Desain',
                'hari' => 'Kamis',
                'tanggal' => '2026-03-18',
                'tempat' => 'Yogyakarta'
            ],

        ];

        foreach ($data as $item) {

            $pelatihan = Pelatihan::create($item);

            Uraian::create([
                'pelatihan_id' => $pelatihan->id,
                'urutan' => 1,
                'uraian_kegiatan' => 'Persiapan',
                'tanggal' => $item['tanggal'],
                'progres' => 'selesai',
                'pic' => 'BPSDM',
                'link' => 'https://google.com',
                'keterangan' => 'Persiapan selesai'
            ]);

            Uraian::create([
                'pelatihan_id' => $pelatihan->id,
                'urutan' => 2,
                'uraian_kegiatan' => 'Pelaksanaan',
                'tanggal' => $item['tanggal'],
                'progres' => 'on progress',
                'pic' => 'BPSDM',
                'link' => null,
                'keterangan' => 'Sedang berlangsung'
            ]);

            Uraian::create([
                'pelatihan_id' => $pelatihan->id,
                'urutan' => 3,
                'uraian_kegiatan' => 'Evaluasi',
                'tanggal' => $item['tanggal'],
                'progres' => 'belum',
                'pic' => 'BPSDM',
                'link' => null,
                'keterangan' => 'Belum dimulai'
            ]);
        }
    }
}