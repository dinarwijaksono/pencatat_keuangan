<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ImportExport_service
{
    public function setFormat(): void
    {
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', "N0");
        $activeWorksheet->setCellValue('B1', 'Tanggal');
        $activeWorksheet->setCellValue('C1', 'Bulan');
        $activeWorksheet->setCellValue('D1', 'Tahun');
        $activeWorksheet->setCellValue('E1', 'Kategori');
        $activeWorksheet->setCellValue('F1', 'Deskripsi');
        $activeWorksheet->setCellValue('G1', 'Type (income / spending)');
        $activeWorksheet->setCellValue('H1', 'Value');

        $s = Storage::disk('local-custom');
        $s->makeDirectory("Format");

        $writer = new Xlsx($spreadsheet);
        $writer->save("public/storage/Format/format.xlsx");
    }
}
