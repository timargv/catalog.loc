<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Entity\Shop\Delivery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeliveriesController extends Controller
{

    public function index()
    {
        $deliveries = Delivery::orderBy('sort')->get();
        return view('admin.deliveries.index', compact('deliveries'));
    }

    public function create()
    {
        return view('admin.deliveries.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:deliveries,title|string|max:255',
            'cost' => 'required|integer',
            'min_weight' => 'nullable|integer',
            'max_weight' => 'nullable|integer',
            'sort' => 'nullable|integer'
        ]);

        $delivery = Delivery::create([
            'title' => $request['title'],
            'cost' => $request['cost'],
            'min_weight' => $request['min_weight'],
            'max_weight' => $request['max_weight'],
            'sort' => $request['sort']
        ]);

        return view('admin.deliveries.show', compact('delivery'));
    }


    public function show(Delivery $delivery)
    {
        //
    }


    public function edit(Delivery $delivery)
    {
        //
    }


    public function update(Request $request, Delivery $delivery)
    {
        $request->validate([
            'title' => 'required|exists:deliveries,title|string|max:255',
            'cost' => 'required|integer',
            'min_weight' => 'nullable|integer',
            'max_weight' => 'nullable|integer',
            'sort' => 'nullable|integer'
        ]);

        $delivery->update([
            'title' => $request['title'],
            'cost' => $request['cost'],
            'min_weight' => $request['min_weight'],
            'max_weight' => $request['max_weight'],
            'sort' => $request['sort']
        ]);

        return view('admin.deliveries.show', compact('delivery'));
    }


    public function destroy(Delivery $delivery)
    {
        $delivery->delete($delivery);
        return redirect()->route('admin.deliveries.index')->with('success', 'Способ Доставки удалена!');
    }
}
