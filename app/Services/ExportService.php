<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ExportService
{
    public function boot()
    {
        Log::withContext([
            'class' => ExportService::class,
            'user_id' => auth()->user()->id,
            'username' => auth()->user()->username,
        ]);
    }


    public function export(string $username, object $transactions): void
    {
        self::boot();

        try {
            $file = Storage::disk('local-custom');
            $file->makeDirectory("Export");

            $content = '' . PHP_EOL;
            $content .= ";Tanggal;Bulan;Tahun;Periode;Kategori;Deskirpsi;Pemasukan;Pengeluaran;" . PHP_EOL;

            foreach ($transactions as $t) {
                $content .= ";";
                $content .= date('j', $t->date / 1000) . ";";
                $content .= date('n', $t->date / 1000) . ";";
                $content .= date('Y', $t->date / 1000) . ";";
                $content .= "'" . $t->period . ";";
                $content .= $t->category . ";";
                $content .= $t->description . ";";
                $content .= $t->income . ";";
                $content .= $t->spending . ";" . PHP_EOL;
            }

            $file->put("Export/$username-transaction-export.csv", $content);

            Log::info('export success');
        } catch (\Throwable $th) {
            Log::error('export failed', [
                'message' => $th->getMessage()
            ]);
        }
    }
}
