<?php


namespace App\UseCases\Cart;

use App\Entity\Product;
use App\Entity\Shop\Cart;
use App\UseCases\Product\ProductService;
use App\User;

class CartService
{
    private $productService;
    private $cart;
    private $product;
    private $items;

    public function __construct(Product $product, ProductService $productService, Cart $cart)
    {
        $this->productService = $productService;
        $this->cart = $cart;
        $this->product = $product;
    }

    public function getId(): string
    {
        return md5($this->product->id);
    }

    public function getIdMd($id): string
    {
        return md5($id);
    }

    public function getItems(): array
    {
        $this->loadItems();
        return $this->items;
    }

    public function getAmount ()
    {
        $this->loadItems();
        return count($this->items);
    }

    public function getCart()
    {
        $user = \Auth::user();
        $card = $this->cart->where('user_id', $user->id)->with('product')->get();
        return $card;
    }

    public function add($productId, $quantity) {
        $items = \Session::get('cart', []);

        $product = $this->productService->getProduct($productId);

        $items[] = [
            'id' => $this->getIdMd($product->id),
            'product' => $product,
            'quantity' => $quantity
        ];

        \Session::put('cart', $items);
    }

    public function remove($id) {

        if (auth()->user()) {
            $this->loadItems();
            foreach ($this->items as $i => $item) {

                if ($item['id'] == $this->getIdMd($id)) {
                    unset($this->items[$i]);
                    $this->saveItems();
                    return;
                }
            }
        }
    }


    public function loadItems() {
        return $this->items = \Session::get('cart');
    }

    private function saveItems(): void
    {
        \Session::put('cart', $this->items);
    }


}