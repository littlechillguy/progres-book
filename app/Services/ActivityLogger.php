<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ActivityLogger
{
    public static function log(
        string $modul,
        string $aksi,
        ?int $referensiId,
        string $deskripsi,
        array $oldValue = [],
        array $newValue = []
    ): void {

        $log = ActivityLog::create([

            'user_id' => Auth::id(),

            'modul' => $modul,

            'aksi' => strtoupper($aksi),

            'referensi_id' => $referensiId,

            'deskripsi' => $deskripsi,

            'old_value' => empty($oldValue) ? null : $oldValue,

            'new_value' => empty($newValue) ? null : $newValue,

        ]);

        // Maksimal 100 activity log
        $count = ActivityLog::count();

        if ($count > 100) {

            $delete = $count - 100;

            ActivityLog::oldest()
                ->take($delete)
                ->delete();

        }

    }
}