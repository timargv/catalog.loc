<?php


namespace App\UseCases\Cart;

use App\Entity\Shop\Cart;
use App\UseCases\Product\ProductService;
use App\User;

class CartService
{
    private $productService;
    private $cart;

    public function __construct(ProductService $productService, Cart $cart)
    {
        $this->productService = $productService;
        $this->cart = $cart;
    }

//    public function getCart($cart) {
//        return Cart::findOrFail($cart->id);
//    }
//
//    public function delete($product) {
//        $user = \Auth::user();
//        $user->cart()->where('product_id', $product)->delete();
//    }

    public function getCartProduct()
    {
    }

    public function getCart()
    {
        $user = \Auth::user();
        $card = $this->cart->where('user_id', $user->id)->with('product')->get();
        return $card;
    }

}