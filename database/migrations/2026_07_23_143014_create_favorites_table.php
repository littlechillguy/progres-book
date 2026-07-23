<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {

            $table->id();

            // User yang memberi favorit
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Pelatihan yang difavoritkan
            $table->foreignId('pelatihan_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();

            // Mencegah user yang sama memfavoritkan pelatihan yang sama lebih dari sekali
            $table->unique(['user_id', 'pelatihan_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};