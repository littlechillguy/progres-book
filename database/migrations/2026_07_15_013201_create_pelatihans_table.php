<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelatihans', function (Blueprint $table) {
            $table->id();

            $table->string('nama_pelatihan');
            $table->string('tahapan');
            $table->string('kegiatan');
            $table->string('hari');
            $table->date('tanggal');
            $table->string('tempat');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelatihans');
    }
};