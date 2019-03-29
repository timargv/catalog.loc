<?php

namespace App\Http\Controllers;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Shop\Cart;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Request $request)
    {
//        session()->forget('cart');



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

        if (!empty($value = $request->get('vendor_code'))) {
            $query->where('vendor_code', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('price'))) {
            $query->where('price', '>=', $value)->orderBy('price', 'ASC');
        }

        if (!empty($value = $request->get('vendor_price'))) {
            $query->where('vendor_price', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('category'))) {
            $query->where('category_id', $value);
        }

        $products = $query->paginate(32);

        return view('home', compact('products', 'categories'));
    }
}
