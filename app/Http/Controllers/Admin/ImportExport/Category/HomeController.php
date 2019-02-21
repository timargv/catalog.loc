<?php

namespace App\Http\Controllers\Admin\ImportExport\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function category()
    {
        return view('admin.import-export.category.index');
    }
}
