<?php

namespace App\Http\Controllers\Admin\ImportExport\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use App\Jobs\MirInstrument\Product as JobProduct;

class XmlController extends Controller
{
    // Импорт XML ПРОДУКТ
    // МИР ИНСТРУМЕНТА
    //=====================================
    public function instrumentImportProductXml () {
        $productJob = (new JobProduct())->delay(Carbon::now()->addSeconds(3));
        dispatch($productJob);

        return redirect()->back()->with('info', 'Через пару минут Товары обновятся');
    }


}
