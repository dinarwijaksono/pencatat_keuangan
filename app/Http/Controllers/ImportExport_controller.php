<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportExport_controller extends Controller
{
    public function index()
    {
        return view("ImportExport/index");
    }


    public function downloadFormat()
    {
        $link = url("storage/Format/format.xlsx");

        return redirect($link);
    }
}
