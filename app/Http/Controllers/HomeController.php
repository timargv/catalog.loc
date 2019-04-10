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


        return view('home', compact('categories', 'widgetsHome'));
    }
}
