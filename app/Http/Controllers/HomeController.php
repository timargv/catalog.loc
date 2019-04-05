<?php

namespace App\Http\Controllers;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Shop\Cart;
use App\Entity\Shop\Widgets\Widget;
use App\UseCases\Widget\WidgetService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $widgetService;

    public function __construct(WidgetService $widgetService)
    {
        $this->widgetService = $widgetService;
    }


    public function index(Request $request)
    {
//        session()->forget('cart');


        $widgetsHome = $this->widgetService->getAll();



        $categories = Category::defaultOrder()->withDepth()->get();
        if (empty($request->all())) {
            $products = Product::orderBy('id', 'DESC')->with('category', 'currency', 'vendor', 'photos');
        } else {
            $products = Product::with('category', 'currency', 'vendor', 'photos');
        }

        $query = $products;

        if (!empty($value = $request->get('name'))) {
            $query->where([['name_original', 'like', '%' . $value . '%'],['name', 'like', '%' . $value . '%']])->orWhere('vendor_code', 'like', '%' . $value . '%');
        }

        $products = $query->orderBy('id', 'DESC')->paginate(36);

        return view('home', compact('products', 'categories', 'widgetsHome'));
    }
}
