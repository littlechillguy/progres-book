<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('uraians', function (Blueprint $table) {

            $table->dropColumn('link');

            $table->string('lampiran')->nullable()->after('pic');

            $table->string('lampiran_nama')->nullable()->after('lampiran');

            $table->string('lampiran_tipe')->nullable()->after('lampiran_nama');

        });
    }

    public function down(): void
    {
        Schema::table('uraians', function (Blueprint $table) {

            $table->dropColumn([
                'lampiran',
                'lampiran_nama',
                'lampiran_tipe'
            ]);

            $table->text('link')->nullable();

        });
    }
};