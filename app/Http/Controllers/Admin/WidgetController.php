<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Product;
use App\Entity\Shop\Widgets\Widget;
use App\Entity\Shop\Widgets\WidgetProductItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WidgetController extends Controller
{

    public function index()
    {
        $widgets = Widget::paginate(15);
        return view('admin.widgets.index', compact('widgets'));
    }


    public function create()
    {
        return view('admin.widgets.create');
    }

    public function store(Request $request)
    {
        $products = Product::all();
        $request->validate([
            'title' => 'required'
        ]);

        $widget = Widget::create([
            'title' => $request['title']
        ]);

        $widget->setProducts($request->get('products'));


        return view('admin.widgets.show', compact('widget', 'products'));

    }

    public function show(Widget $widget)
    {
        $products = Product::all();
        $widgetItems = $widget->widgetProductItems()->paginate(15);
        return view('admin.widgets.show', compact('widget', 'products', 'widgetItems'));
    }


    public function edit(Widget $widget)
    {
        return view('admin.widgets.edit', compact('widget'));
    }


    public function update(Request $request, Widget $widget)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $widget->update([
            'title' => $request['title']
        ]);

//        $widget->products()->detach();
        $widget->setProducts($request->get('products'));

        return redirect()->route('admin.widgets.show', $widget)->with('success', 'Виджет обнавлен');
    }


    public function add(Request $request, Widget $widget)
    {
        try {
            $widget->addProduct($request->get('products'));
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }
        return redirect()->route('admin.widgets.show', $widget)->with('success', 'Добавлены товары в Виджет');
    }


    public function deleteWidgetProductItem(Widget $widget, $productId)
    {
        $widget->widgetProductItems()->where('product_id', $productId)->delete();
        return redirect()->route('admin.widgets.show', $widget)->with('success', 'Товар удален из Виджета');
    }


    public function destroy(Widget $widget)
    {
        $widget->widgetProductItems()->detach();
        $widget->delete();
        return redirect()->route('admin.widgets.index')->with('success', 'Виджет удален');
    }
}
