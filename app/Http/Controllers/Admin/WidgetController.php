<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Shop\Widgets\Widget;
use App\Entity\Shop\Widgets\WidgetProductItem;
use App\Http\Controllers\Controller;
use App\UseCases\Widget\WidgetService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class WidgetController extends Controller
{

    public $service;

    public function __construct(WidgetService $widgetService)
    {
        $this->service = $widgetService;
    }

    public function index()
    {
        $widgets = Widget::paginate(15);
        return view('admin.widgets.index', compact('widgets'));
    }


    public function create()
    {
        $statuses = Widget::statusesAvailable();
        $options = Widget::optionsList();
        $types = Widget::typesList();

        return view('admin.widgets.create', compact('options', 'statuses', 'types'));
    }

    public function store(Request $request)
    {
        $products = Product::all();
        $categories = Category::all();
        $request->validate([
            'title' => 'required',
            'type' => ['required', 'string', 'max:255', Rule::in(array_keys(Widget::typesList()))],
            'status' => ['required', 'string', 'max:255', Rule::in(array_keys(Widget::statusesAvailable()))],
        ]);

        $widget = Widget::create([
            'title' => $request['title'],
            'type' => $request['type'],
            'status' => $request['status'],
        ]);

//        $widget->setProducts($request->get('products'));
        if ($widget->type === Widget::TYPE_PRODUCT) {
            $widgetItems = $widget->widgetProductItems()->paginate(15);
            return view('admin.widgets.show', compact('widget', 'products', 'widgetItems'));
        }
        $widgetItems = $widget->widgetCategoryItems()->paginate(15);
        return view('admin.widgets.show', compact('widget', 'categories', 'widgetItems'));

    }

    public function show(Widget $widget)
    {
        if ($widget->isTypeProduct()) {
            $products = Product::all();
            $widgetItems = $widget->widgetProductItems()->paginate(15);
            return view('admin.widgets.show', compact('widget', 'products', 'widgetItems'));
        }
        $categories = Category::defaultOrder()->withDepth()->get();
        $widgetItems = $widget->widgetCategoryItems()->paginate(15);
        return view('admin.widgets.show', compact('widget', 'categories', 'widgetItems'));

    }


    public function edit(Widget $widget)
    {
        $statuses = Widget::statusesAvailable();
        $options = Widget::optionsList();
        $types = Widget::typesList();

        return view('admin.widgets.edit', compact('widget', 'options', 'statuses', 'types'));
    }


    public function update(Request $request, Widget $widget)
    {
        $request->validate([
            'title' => 'required',
            'type' => ['required', 'string', 'max:255', Rule::in(array_keys(Widget::typesList()))],
            'status' => ['required', 'string', 'max:255', Rule::in(array_keys(Widget::statusesAvailable()))],
        ]);

        $widget->update([
            'title' => $request['title'],
            'type' => $request['type'],
            'status' => $request['status'],
        ]);

        return redirect()->route('admin.widgets.show', $widget)->with('success', 'Виджет обнавлен');
    }

    public function dataAjax(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Product::where('name','LIKE',"%$search%")
                ->orWhere('name_original','LIKE',"%$search%")
                ->orWhere('vendor_code','LIKE',"%$search%")
                ->select('id', 'name')
                ->get();
        }


        return response()->json($data);
    }


    public function add(Request $request, Widget $widget)
    {
        try {
            $this->service->addVariant($widget, $request->get('widgetItemId'));
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }
        return redirect()->route('admin.widgets.show', $widget)->with('success', 'Добавлен в Виджет');
    }


    public function deleteWidgetItem(Widget $widget, $itemId)
    {
        try {
            $this->service->deleteItem($widget, $itemId);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }
        return redirect()->route('admin.widgets.show', $widget)->with('success', 'Товар удален из Виджета');
    }


    public function destroy(Widget $widget)
    {
        $widget->widgetProductItems()->delete();
        $widget->delete();
        return redirect()->route('admin.widgets.index')->with('success', 'Виджет удален');
    }
}
