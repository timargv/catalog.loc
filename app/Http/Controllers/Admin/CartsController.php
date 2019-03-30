<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Shop\Cart;
use App\UseCases\Cart\CartService;
use App\User;
use function Complex\theta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartsController extends Controller
{
    private $cartItems;
    private $service;

    public function __construct(Cart $cart, CartService $service)
    {
        $this->cartItems = $cart;
        $this->service = $service;
    }


    public function index()
    {
        $cartItems = Cart::orderBy('id')->with('user','product')->get();
        $cart = $this->cartItems;
        return view('admin.carts.index', compact('cartItems', 'cart'));
    }

    public function show($user) {
        $user = User::findOrFail($user);
        $cartItems = $this->cartItems->where('user_id', $user->id)->with('product')->orderBy('updated_at')->paginate(15);
        return view('admin.carts.show', compact('cartItems', 'user'));
    }
}
