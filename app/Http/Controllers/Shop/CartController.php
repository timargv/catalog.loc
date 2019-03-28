<?php

namespace App\Http\Controllers\Shop;

use App\Entity\Shop\Cart;
use App\Http\Controllers\Controller;
use App\Jobs\MirInstrument\Product;
use App\UseCases\Cart\CartService;
use App\UseCases\Product\ProductService;
use App\User;
use Illuminate\Http\Request;

class CartController extends Controller
{

    private $service;
    private $user;
    private $productService;
    private $cart;

    public function __construct(CartService $service, User $user, ProductService $productService)
    {
        $this->service = $service;
        $this->user = $user;
        $this->productService = $productService;
    }

    public function story ($id) {
        if (!$product = $this->productService->getProduct($id)) {
            throw new \DomainException('The requested page does not exist.');
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function show()
    {

        try {
            $this->cart = $this->service->getCart();
            $cartItems = $this->cart;
        } catch (\DomainException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return view('shop.cart.show', compact('cartItems'));
    }

    public function update(Request $request, Cart $cart)
    {
        //
    }

    public function deleteProductCart ($product) {
        try {
            $this->service->delete($product);
        } catch (\DomainException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->back()->with('info', 'Товар удален из корзины!');
    }

    public function destroy(Cart $cart)
    {
//        $this->service
        return redirect()->back()->with('Товар удален из корзины');
    }
}
