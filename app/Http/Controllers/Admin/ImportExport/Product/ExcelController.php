<?php

namespace App\Http\Controllers\Admin\ImportExport\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExcelController extends Controller
{
    //
    public function importExcel()
    {
        return view('admin.import-export.import');
    }

    //
    public function exportExcel()
    {
        return view('admin.import-export.export');
    }
}
