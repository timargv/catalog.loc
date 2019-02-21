<?php
/**
 * Created by PhpStorm.
 * User: Jo
 * Date: 07.02.2019
 * Time: 13:12
 */

namespace App\UseCases\Category;

use App\Jobs\MirInstrument\CategoryFix;
use Illuminate\Support\Carbon;

class CategoryService
{

    // Фикс после импорта Категории
    // МИР ИНСТРУМЕНТА
    //=====================================
    public function fix () {
        $categoryJob = (new CategoryFix())->delay(Carbon::now()->addSeconds(3));
        dispatch($categoryJob);

        return redirect()->back()->with('info', 'Категории скоро будут Пофиксены');
    }
}