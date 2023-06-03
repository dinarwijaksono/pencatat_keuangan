<?php

namespace App\Services;

use App\Domains\Category_domain;
use App\Domains\Transaction_domain;
use App\Repository\Category_repository;
use App\Repository\Transaction_repository;
use App\Repository\User_repository;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as Reader;

class ImportExport_service
{
    protected $userRepository;
    protected $categoryRepository;
    protected $transactionRepository;

    public function __construct(
        User_repository $userRepository,
        Category_repository $categoryRepository,
        Transaction_repository $transactionRepository
    ) {
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
        $this->transactionRepository = $transactionRepository;
    }





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
        $s->makeDirectory("Format/");

        $writer = new Xlsx($spreadsheet);
        $writer->save("storage/Format/format.xlsx");
    }




    public function import(string $username, $file)
    {
        $reader = new Reader();
        $spreadsheet = $reader->load($file);

        $worksheet = $spreadsheet->getActiveSheet()->toArray();

        array_splice($worksheet, 0, 1);

        $user = $this->userRepository->getByUsername($username);

        $errors = [];

        $row = 0;
        for ($i = 0; $i < count($worksheet); $i++) :
            $row++;
            $valid = true;

            // // validasi tanggal
            if (!is_numeric($worksheet[$i][1]) || $worksheet[$i][1] > 32 || $worksheet[$i][1] < 1) {
                $error = "Baris no $row gagal di import, karena tanggal tidak valid.";
                $valid = false;
            }

            // // validasi bulan
            if (!is_numeric($worksheet[$i][2]) || $worksheet[$i][2] > 13 || $worksheet[$i][2] < 1) {
                $error = "Baris no $row gagal di import, karena bulan tidak valid.";
                $valid = false;
            }

            // validasi tahun 
            if (!is_numeric($worksheet[$i][3]) || $worksheet[$i][3] < 1 || $worksheet[$i][3] > 10000) {
                $error = "Baris no $row gagal di import, karena tahun tidak valid.";
                $valid = false;
            }

            // validasi kategori 
            if (!is_string($worksheet[$i][4]) || trim($worksheet[$i][4]) == '') {
                $error = "Baris no $row gagal di import, karena nama kategori tidak valid.";
                $valid = false;
            }

            // validasi deskripsi / item
            if (!is_string($worksheet[$i][5]) || trim($worksheet[$i][5]) == '') {
                $error = "Baris no $row gagal di import, karena deskripsi tidak valid.";
                $valid = false;
            }

            // validasi type
            if (
                !is_string($worksheet[$i][6]) ||
                trim($worksheet[$i][6]) == "" ||
                !in_array(trim(strtolower($worksheet[$i][6])), ['spending', 'income'])
            ) {
                $error = "Baris no $row gagal di import, karena type tidak valid";
                $valid = false;
            }

            // validasi value
            if (
                !is_numeric($worksheet[$i][7]) ||
                trim($worksheet[$i][7]) == "" ||
                $worksheet[$i][7] < 0
            ) {
                $error = "Baris no $row gagal di import, karena value tidak valid.";
                $valid = false;
            }

            if (!$valid) {
                $errors[] = $error;
            }

            if ($valid) :
                // cek apakah kategori sudah ada, jika belum buat terlebih dahulu
                if (!$this->categoryRepository->isExists($user->id, strtolower($worksheet[$i][4]), strtolower($worksheet[$i][6]))) {
                    $categoryDomain = new Category_domain($user->id);
                    $categoryDomain->code = 'C' . mt_rand(1, 9999999);
                    $categoryDomain->name = strtolower(trim($worksheet[$i][4]));
                    $categoryDomain->type = strtolower(trim($worksheet[$i][6]));
                    $this->categoryRepository->create($categoryDomain);
                }

                $category = $this->categoryRepository->getByUserIdAndName($user->id, $worksheet[$i][4]);
                $date = mktime(0, 0, 0, $worksheet[$i][2], $worksheet[$i][1], $worksheet[$i][3]);

                // buat transaksi
                $transaction = new Transaction_domain($user->id);
                $transaction->category_id = $category->id;
                $transaction->code = 'T' . mt_rand(1, 9999999);
                $transaction->period = date('M-Y', $date);
                $transaction->date = $date * 1000;
                $transaction->type = strtolower(trim($worksheet[$i][6]));
                $transaction->item = strtolower(trim($worksheet[$i][5]));
                $transaction->value = $worksheet[$i][7];

                $this->transactionRepository->create($transaction);
            endif;
        endfor;

        return $errors;
    }


    public function export(string $period, string $username)
    {
        $user = $this->userRepository->getByUsername($username);
        $transactionList = $this->transactionRepository->getByPeriod($period, $user->id);

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

        $i = 2;
        foreach ($transactionList as $transaction) :
            $activeWorksheet->setCellValue("A" . $i, $i - 1);
            $activeWorksheet->setCellValue("B" . $i, date('j', $transaction->date / 1000));
            $activeWorksheet->setCellValue("C" . $i, date('n', $transaction->date / 1000));
            $activeWorksheet->setCellValue("D" . $i, date('Y', $transaction->date / 1000));
            $activeWorksheet->setCellValue("E" . $i, $transaction->category_name);
            $activeWorksheet->setCellValue("F" . $i, $transaction->item);
            $activeWorksheet->setCellValue("G" . $i, $transaction->type);
            $activeWorksheet->setCellValue("H" . $i, $transaction->value);

            $i++;
        endforeach;

        $s = Storage::disk('local-custom');
        $s->makeDirectory("Import/$username");

        $writer = new Xlsx($spreadsheet);
        $writer->save("storage/Import/$username/export.xlsx");
    }
}
