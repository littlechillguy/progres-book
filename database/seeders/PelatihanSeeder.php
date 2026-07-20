<?php

namespace Database\Seeders;

use App\Models\Pelatihan;
use App\Models\Uraian;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PelatihanSeeder extends Seeder
{
    public function run(): void
    {
        $pelatihans = [
            ['nama_pelatihan'=>'Pelatihan Laravel Fundamental','tahapan'=>'Pelaksanaan','kegiatan'=>'Pelatihan Backend Laravel','hari'=>'Senin','tanggal'=>'2026-01-12','tempat'=>'Jakarta'],
            ['nama_pelatihan'=>'Workshop Cyber Security','tahapan'=>'Persiapan','kegiatan'=>'Pelatihan Keamanan Siber','hari'=>'Selasa','tanggal'=>'2026-02-20','tempat'=>'Bandung'],
            ['nama_pelatihan'=>'Pelatihan UI/UX Design','tahapan'=>'Evaluasi','kegiatan'=>'Desain Antarmuka Aplikasi','hari'=>'Kamis','tanggal'=>'2026-03-18','tempat'=>'Yogyakarta'],
            ['nama_pelatihan'=>'Pelatihan Cloud Computing','tahapan'=>'Pelaksanaan','kegiatan'=>'Implementasi Cloud','hari'=>'Rabu','tanggal'=>'2026-04-10','tempat'=>'Surabaya'],
            ['nama_pelatihan'=>'Pelatihan Digital Forensik','tahapan'=>'Persiapan','kegiatan'=>'Investigasi Digital','hari'=>'Jumat','tanggal'=>'2026-05-15','tempat'=>'Medan'],
        ];

        $templateUraian = [
            'Penyusunan TOR','Penyusunan Jadwal','Penyusunan Anggaran','Penyusunan Modul',
            'Koordinasi Internal','Koordinasi Narasumber','Pengiriman Undangan','Registrasi Peserta',
            'Persiapan Ruangan','Persiapan Peralatan','Briefing Panitia','Pembukaan Acara',
            'Penyampaian Materi 1','Penyampaian Materi 2','Diskusi Kelompok','Praktik Mandiri',
            'Pendampingan Peserta','Post Test','Evaluasi Peserta','Penyusunan Laporan'
        ];

        $pics = [
            'BPSDM',
            'Panitia',
            'Sekretariat',
            'Tim IT',
            'Narasumber',
            'Instruktur',
            'Admin',
            'Ketua Panitia'
        ];

        foreach ($pelatihans as $index => $data) {

            $pelatihan = Pelatihan::create($data);

            $baseDate = Carbon::parse($data['tanggal'])->subDays(20);

            foreach ($templateUraian as $i => $uraian) {

                $status = $i < 10
                    ? 'selesai'
                    : ($i < 15 ? 'on progress' : 'belum');

                Uraian::create([
                    'pelatihan_id'    => $pelatihan->id,
                    'urutan'          => $i + 1,
                    'uraian_kegiatan' => $uraian . ' - ' . $pelatihan->nama_pelatihan,
                    'tanggal'         => $baseDate->copy()->addDays($i),
                    'progres'         => $status,
                    'pic'             => $pics[($i + $index) % count($pics)],

                    // Lampiran
                    'lampiran'        => null,
                    'lampiran_nama'   => null,
                    'lampiran_tipe'   => null,

                    'keterangan'      => 'Kegiatan ' . $uraian . ' untuk ' . $pelatihan->nama_pelatihan,
                ]);
            }
        }
    }
}