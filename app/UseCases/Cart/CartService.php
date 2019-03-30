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

    public function add($productId, $quantity)
    {
        if (!auth()->user()) {
            $items = \Session::get('cart', []);

            $product = $this->productService->getProduct($productId);

            $items[] = [
                'id' => $this->getIdMd($product->id),
                'product' => $product,
                'quantity' => $quantity
            ];

            $this->loadItems();
            if ($this->items) {
                foreach ($this->items as $i => $item) {
                    if ($item['id'] == $this->getIdMd($productId)) {
                        $this->set($productId, 0);
                        return;
                    }
                }
            }
            \Session::put('cart', $items);
        } else {
            $this->addItemsCartDB($productId, $quantity);
        }

    }

    public function addItemsCartDB($productId, $quantity){



        $product = $this->productService->getProduct($productId);

        if (!$product) { return; }

        $cardItems = $this->cart->where([
            ['user_id', '=', auth()->id()],
            ['product_id', '=', $productId],
        ])->first();


        if ($cardItems) {
            $cardItems->update([
                'quantity' => $cardItems->quantity + $quantity
            ]);

        } else {
            $cartItem = $this->cart->make([
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
            $cartItem->user()->associate(auth()->user());
            $cartItem->saveOrFail();
        }
    }

    public function set($id, $quantity): void
    {
        if (!auth()->user()) {
            $this->loadItems();
            foreach ($this->items as $i => $item) {
                if ($item['id'] == $this->getIdMd($id)) {
                    $this->items[$i]['quantity'] += 1;
                    $this->saveItems();
                    return;
                }
            }
            throw new \DomainException('Item is not found.');
        }
    }

    public function remove($id) {

        if (!auth()->user()) {
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

    public function addProductsCart($items)
    {
        if (!empty($user = auth()->user())) {
            foreach ($items as $i => $item) {

                $cartItem = Cart::where([
                    ['user_id', '=', $user->id],
                    ['product_id', '=', $item['product']->id],
                ])->first();

                if ($cartItem) {

                    $cartItem->update([
                        'quantity' => $item['quantity']
                    ]);

                } else {
                    $itemCart = $this->cart->make([
                        'product_id' => $item['product']->id,
                        'quantity' => $item['quantity']
                    ]);

                    $itemCart->user()->associate($user);
                    $itemCart->saveOrFail();
                }

            }
            session()->forget('cart');
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
