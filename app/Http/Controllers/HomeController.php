<?php

namespace App\Http\Controllers;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Shop\Attribute\Attribute;
use App\Entity\Shop\Attribute\AttributeGroup;
use App\Entity\Shop\Cart;
use App\Entity\Shop\Product\Value;
use App\Entity\Shop\Widgets\Widget;
use App\UseCases\Category\FilterProductService;
use App\UseCases\Widget\WidgetService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $widgetService;
    private $products;
    private $attribute;
    public $filterProductService;

    public function __construct(WidgetService $widgetService, Product $products, Attribute $attribute, FilterProductService $filterProductService)
    {
        $this->widgetService = $widgetService;
        $this->products = $products;
        $this->attribute = $attribute;
        $this->filterProductService = $filterProductService;
    }


    public function index(Request $request)
    {
//        session()->forget('cart');

        $widgetsHome = $this->widgetService->getAll();
        
        $categories = Category::defaultOrder()->withDepth()->get();

        return view('home', compact('categories', 'widgetsHome'));
    }

    public function category(Request $request, Category $category, $slug) {

        $category = $category->where('slug', $slug)->orWhere('id', $slug)->firstOrFail();

        $query = $category ? $category->children()->where('status', 'active') : Category::whereIsRoot();
        $categories = $query->defaultOrder()->getModels();

        if ($request->all()) {
            $products = $this->filterProductService->filter($request, $category);
            return view('shop.category.show', compact('category', 'categories', 'products'));
        }

        $categoryIds = $category->descendants()->pluck('id');

        $products = $category->products()->paginate(16);

        


        if (count($products) == 0) {
            $products = Product::whereIn('category_id', $categoryIds)->paginate(16);
        }

        

        return view('shop.category.show', compact('category', 'categories', 'products'));
    }

    //----------------------------------
    public function product(Product $product, $slug)
    {
        $product = $product->where([
            ['slug', $slug],
            ['status', 'active']
        ])->orWhere([
            ['id', $slug],
            ['status', 'active']
        ])->firstOrFail();

        return view('shop.products.show', compact('product'));
    }
}
