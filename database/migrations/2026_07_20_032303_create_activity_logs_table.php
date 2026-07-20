<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('modul');
            // Pelatihan / Uraian

            $table->string('aksi');
            // CREATE UPDATE DELETE

            $table->unsignedBigInteger('referensi_id')->nullable();

            $table->text('deskripsi');

            $table->json('old_value')->nullable();

            $table->json('new_value')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};