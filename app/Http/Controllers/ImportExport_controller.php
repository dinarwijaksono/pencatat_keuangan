<?php

namespace App\Http\Controllers;

use App\Services\ImportExport_service;
use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx as Reader;

class ImportExport_controller extends Controller
{
    protected $importExportService;

    public function __construct(ImportExport_service $importExportService)
    {
        $this->importExportService = $importExportService;
    }



    public function index()
    {
        return view("ImportExport/index");
    }


    public function downloadFormat()
    {
        $link = url("storage/Format/format.xlsx");

        return redirect($link);
    }


    public function doImport(Request $request)
    {
        $request->validate([
            'file' => 'required'
        ]);

        $file = $request->file('file');

        if (strtolower($file->getClientOriginalExtension()) !== 'xlsx') {
            return back()->with('importFailed', "Dokumen tidak bisa di import karena extension tidak di dukung.");
        }


        $username = session()->get('username');

        $file->storePubliclyAs("/Import/$username", $file->getClientOriginalName(), 'local-custom');

        $import = $this->importExportService->import($username, $file);

        if (!empty($import)) {
            session()->flash("listImportError", $import);
        }

        return back();
    }
}
