<?php

namespace App\Http\Controllers\Admin\ImportExport\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Jobs\MirInstrument\Category as JobCategory;
use App\Http\Controllers\Controller;

class XmlController extends Controller
{

    // Импорт XML Категории
    // МИР ИНСТРУМЕНТА
    //=====================================
    public function instrumentImportCategoryXml () {
        $categoryJob = (new JobCategory())->delay(Carbon::now()->addSeconds(5));
        dispatch($categoryJob);

        return redirect()->back()->with('info', 'Через пару минут Категория обновятся');
    }

}
