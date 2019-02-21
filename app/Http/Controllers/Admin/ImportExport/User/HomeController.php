<?php

namespace App\Http\Controllers\Admin\ImportExport\User;

use App\Imports\Admin\UsersImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function userImport(Request $request) {
        $request->validate([
            'file' => 'required',
        ]);

        $path = $request->file('file');
        $import = new UsersImport();

        try {
            $import->import($path);
//            (new UsersImport)->import($path);
        } catch (\Exception $e) {
            $failures = $e->failures();
            dd($failures[0]);
        }


//        dd('Row count: ' . $import->getRowCount());


        if (!empty($errors)) {
            dd($errors);
            return redirect()->back()->with('success', 'All good!');
        }


//        return redirect()->route('admin.users.index', compact('errors'));


        return redirect()->back()->with('info', 'Через пару минут Пользотели будут добавлены или обновлены');
    }
}
