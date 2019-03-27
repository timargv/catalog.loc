<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Entity\Shop\OrderStatusesList;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderStatusesListController extends Controller
{

    public function index(Request $request)
    {
        $statuses = OrderStatusesList::all();
        return view('admin.order-statuses-lists.index', compact('statuses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
           'title' => 'required|string|unique:order_statuses_lists|max:255',
            'color' => 'required|string|unique:order_statuses_lists|max:255'
        ]);

        OrderStatusesList::create([
            'title' => $request->title,
            'color' => $request->color,
        ]);

        return redirect()->back()->with('success', 'Стату создан '.$validated['title']);
    }

    public function edit(OrderStatusesList $status)
    {
        return view('admin.order-statuses-lists.edit', compact('status'));
    }

    public function update(Request $request, OrderStatusesList $status)
    {
        $request->validate([
            'title' => 'required|string|max:255|exists:order_statuses_lists,title',
//            'color' => 'required|string|max:255|exists:order_statuses_lists'
        ]);

        $status->update([
            'title' => $request->title,
            'color' => $request->color,
        ]);

        return redirect()->route('admin.order-statuses-list.index')->with('success', 'Статуса '.$status->title. ' обновлено');
    }

    public function destroy(OrderStatusesList $orderStatusesList)
    {
        //
    }
}
