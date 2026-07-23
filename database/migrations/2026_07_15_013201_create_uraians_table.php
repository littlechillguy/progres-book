<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('uraians', function (Blueprint $table) {

            $table->id();

            $table->foreignId('pelatihan_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->unsignedInteger('urutan');

            // Tahapan
            $table->enum('tahapan', [
                'Persiapan',
                'Pelaksanaan',
                'Evaluasi'
            ]);

            $table->text('uraian_kegiatan');

            $table->date('tanggal');

            $table->enum('progres', [
                'belum',
                'on progress',
                'selesai'
            ])->default('belum');

            $table->date('tanggal_selesai')->nullable();

            $table->string('pic')->nullable();

            $table->string('lampiran')->nullable();
            $table->string('lampiran_nama')->nullable();
            $table->string('lampiran_tipe')->nullable();

            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('uraians');
    }
};