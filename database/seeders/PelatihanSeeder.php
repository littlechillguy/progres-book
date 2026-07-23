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

        $template = [

            ['Persiapan','Penyusunan TOR'],
            ['Persiapan','Penyusunan Jadwal'],
            ['Persiapan','Penyusunan Anggaran'],
            ['Persiapan','Penyusunan Modul'],
            ['Persiapan','Koordinasi Internal'],
            ['Persiapan','Koordinasi Narasumber'],
            ['Persiapan','Pengiriman Undangan'],
            ['Persiapan','Registrasi Peserta'],

            ['Pelaksanaan','Persiapan Ruangan'],
            ['Pelaksanaan','Persiapan Peralatan'],
            ['Pelaksanaan','Briefing Panitia'],
            ['Pelaksanaan','Pembukaan Acara'],
            ['Pelaksanaan','Penyampaian Materi Sesi 1'],
            ['Pelaksanaan','Penyampaian Materi Sesi 2'],
            ['Pelaksanaan','Diskusi dan Tanya Jawab'],
            ['Pelaksanaan','Praktik Mandiri'],

            ['Evaluasi','Post Test'],
            ['Evaluasi','Evaluasi Peserta'],
            ['Evaluasi','Penyusunan Laporan'],
            ['Evaluasi','Penutupan Kegiatan']

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

            $tanggalMulai = Carbon::parse($pel['tanggal'])->subDays(20);

            foreach ($template as $i => $data) {

                [$tahapan, $kegiatan] = $data;

                if ($tahapan == 'Persiapan') {

                    $status = rand(1,100) <= 85
                        ? 'selesai'
                        : 'on progress';

                } elseif ($tahapan == 'Pelaksanaan') {

                    $acak = rand(1,100);

                    if ($acak <= 50) {

                        $status = 'selesai';

                    } elseif ($acak <= 85) {

                        $status = 'on progress';

                    } else {

                        $status = 'belum';

                    }

                } else {

                    $acak = rand(1,100);

                    if ($acak <= 25) {

                        $status = 'selesai';

                    } elseif ($acak <= 60) {

                        $status = 'on progress';

                    } else {

                        $status = 'belum';

                    }

                }

                $tanggal = $tanggalMulai->copy()->addDays($i);

                $tanggalSelesai = null;

                if ($status == 'selesai') {

                    $tanggalSelesai = $tanggal->copy()->addDays(rand(0,2));

                }

                Uraian::create([

                    'pelatihan_id'    => $pelatihan->id,
                    'urutan'          => $i + 1,
                    'tahapan'         => $tahapan,
                    'uraian_kegiatan' => $kegiatan,
                    'tanggal'         => $tanggal,
                    'tanggal_selesai' => $tanggalSelesai,
                    'progres'         => $status,
                    'pic'             => $pics[array_rand($pics)],

                    'lampiran'        => null,
                    'lampiran_nama'   => null,
                    'lampiran_tipe'   => null,

                    'keterangan'      => 'Pelaksanaan kegiatan "' . $kegiatan . '" pada ' . $pelatihan->nama_pelatihan . '.'

                ]);

            }

        }
    }
}