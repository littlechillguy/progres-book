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

            [
                'nama_pelatihan' => 'Pelatihan Laravel Fundamental',
                'tahapan' => 'Pelaksanaan',
                'kegiatan' => 'Pelatihan Backend Laravel',
                'hari' => 'Senin',
                'tanggal' => '2026-01-12',
                'tempat' => 'Jakarta'
            ],

            [
                'nama_pelatihan' => 'Workshop Cyber Security',
                'tahapan' => 'Persiapan',
                'kegiatan' => 'Pelatihan Keamanan Siber',
                'hari' => 'Selasa',
                'tanggal' => '2026-02-20',
                'tempat' => 'Bandung'
            ],

            [
                'nama_pelatihan' => 'Pelatihan UI/UX Design',
                'tahapan' => 'Evaluasi',
                'kegiatan' => 'Desain Antarmuka Aplikasi',
                'hari' => 'Kamis',
                'tanggal' => '2026-03-18',
                'tempat' => 'Yogyakarta'
            ],

            [
                'nama_pelatihan' => 'Pelatihan Cloud Computing',
                'tahapan' => 'Pelaksanaan',
                'kegiatan' => 'Implementasi Cloud',
                'hari' => 'Rabu',
                'tanggal' => '2026-04-10',
                'tempat' => 'Surabaya'
            ],

            [
                'nama_pelatihan' => 'Pelatihan Digital Forensik',
                'tahapan' => 'Persiapan',
                'kegiatan' => 'Investigasi Digital',
                'hari' => 'Jumat',
                'tanggal' => '2026-05-15',
                'tempat' => 'Medan'
            ]

        ];

        $uraian = [

            'Penyusunan TOR',
            'Penyusunan Jadwal',
            'Penyusunan Anggaran',
            'Penyusunan Modul',
            'Koordinasi Internal',
            'Koordinasi Narasumber',
            'Pengiriman Undangan',
            'Registrasi Peserta',
            'Persiapan Ruangan',
            'Persiapan Peralatan',
            'Briefing Panitia',
            'Pembukaan Acara',
            'Penyampaian Materi Sesi 1',
            'Penyampaian Materi Sesi 2',
            'Diskusi dan Tanya Jawab',
            'Praktik Mandiri',
            'Post Test',
            'Evaluasi Peserta',
            'Penyusunan Laporan',
            'Penutupan Kegiatan'

        ];

        $pics = [

            'Rasya',
            'Dzakwan',
            'BPSDM',
            'Sekretariat',
            'Panitia',
            'Tim IT',
            'Narasumber',
            'Ketua Panitia'

        ];

        foreach ($pelatihans as $pel) {

            $pelatihan = Pelatihan::create($pel);

            $mulai = Carbon::parse($pel['tanggal'])->subDays(rand(18,25));

            foreach ($uraian as $i => $item) {

                $acak = rand(1,100);

                if($acak <= 55){

                    $status = 'selesai';

                }elseif($acak <= 80){

                    $status = 'on progress';

                }else{

                    $status = 'belum';

                }

                $tanggal = $mulai->copy()->addDays(rand($i,$i+2));

                $tanggalSelesai = null;

                if($status == 'selesai'){

                    $tanggalSelesai = $tanggal->copy()->addDays(rand(0,3));

                }

                Uraian::create([

                    'pelatihan_id' => $pelatihan->id,

                    'urutan' => $i+1,

                    'uraian_kegiatan' => $item,

                    'tanggal' => $tanggal,

                    'tanggal_selesai' => $tanggalSelesai,

                    'progres' => $status,

                    'pic' => $pics[array_rand($pics)],

                    'lampiran' => null,

                    'lampiran_nama' => null,

                    'lampiran_tipe' => null,

                    'keterangan' => 'Pelaksanaan kegiatan '.$item.' pada '.$pelatihan->nama_pelatihan.'.'

                ]);

            }

        }
    }
}