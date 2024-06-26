<?php

namespace App\Http\Controllers;

use App\Services\ImportExport_service;
use App\Services\Transaction_service;
use Illuminate\Http\Request;

class ImportExportController extends Controller
{
    protected $transactionService;
    protected $importExportService;

    public function __construct(Transaction_service $transactionService, ImportExport_service $importExportService)
    {
        $this->transactionService = $transactionService;
        $this->importExportService = $importExportService;
    }

    public function index()
    {
        session()->put('active_menu', 'impor-export');

        return view("ImportExport/index");
    }

    public function downloadFormat()
    {
        $link = url("storage/Format/format.xlsx");

        $this->importExportService->setFormat();

        return redirect($link);
    }

    public function doImport(Request $request)
    {
        $request->validate([
            'file' => 'required'
        ]);

        $file = $request->file('file');

        if (strtolower($file->getClientOriginalExtension()) !== 'xlsx') {
            return redirect('/Import-export-data')->with('importFailed', "Dokumen tidak bisa di import karena extension tidak di dukung.");
        }

        $username = auth()->user()->username;

        $file->storePubliclyAs("/Import/$username", $file->getClientOriginalName(), 'local-custom');

        $import = $this->importExportService->import($username, $file);

        if (!empty($import)) {
            session()->flash("listImportError", $import);
        }

        return back();
    }


    public function doExport(Request $request)
    {
        $this->importExportService->export($request->period, session()->get('username'));

        $username = session()->get('username');
        $link = url("storage/Import/$username/export.xlsx");

        return redirect($link);
    }
}
