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



    public function add($id)
    {
        if (!$product = $this->productService->getProduct($id)) {
            throw new \DomainException('The requested page does not exist.');
        }

        try {
            $this->service->add($product->id, 1);
        } catch (\DomainException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        $productPhoto = $product->photos()->get();
        return redirect()->back()->with(
            [
                'success'   =>  'Добавлен в корзину',
                'success_title'    =>  $product->name,
                'success_img'    =>  $productPhoto[0]->file ?:  '',
            ]);
    }



    public function show()
    {

        if (auth()->guest()) {
            $cartItems = \Session::get('cart');
            return view ('shop.cart.show', compact('cartItems'));
        }

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



    public function remove ($id) {

        if (!$product = $this->productService->getProduct($id)) {
            throw new \DomainException('The requested page does not exist.');
        }

        try {
            $this->service->remove($product->id);
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
