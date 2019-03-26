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
        //
    }

    public function edit(OrderStatusesList $orderStatusesList)
    {
        //
    }

    public function update(Request $request, OrderStatusesList $orderStatusesList)
    {
        //
    }

    public function destroy(OrderStatusesList $orderStatusesList)
    {
        //
    }
}
