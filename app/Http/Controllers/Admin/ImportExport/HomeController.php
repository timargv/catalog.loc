<?php

namespace App\Http\Controllers\Admin\ImportExport;

use App\Imports\Admin\UsersImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    //Импорт категории
    public function category()
    {
        return view('admin.import-export.category.index');
    }


    // Импорт Товаров
    public function product()
    {
        return view('admin.import-export.product.index');
    }


    // Импорт USER
    //=====================================
    public function user(Request $request)
    {
        return view('admin.import-export.user.index');
    }

}
