<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurrenciesController extends Controller
{
    public function index(){

        $currencies = Currency::all();
        return view('', compact('currencies'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
