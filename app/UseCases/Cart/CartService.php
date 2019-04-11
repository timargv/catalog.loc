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

    public function getCartAll() {
        return $this->cart->all();
    }

    public function getAmount ()
    {
        $this->loadItems();
        return count($this->items);
    }

    public function getCart()
    {
        if ($user = \Auth::user()) {
            $card = $this->cart->where('user_id', $user->id)->with('product')->get();
            return $card;
        } else {
            return session()->get('cart');
        }
    }

    public function add($productId, $quantity)
    {
        $product = $this->productService->getProduct($productId);

        if (!auth()->user()) {
            $items = \Session::get('cart', []);

            $items[] = [
                'id' => $this->getIdMd($product->id),
                'product' => $product,
                'quantity' => $quantity
            ];


            $this->loadItems();
            if ($this->items) {
                foreach ($this->items as $i => $item) {
                    if ($item['id'] == $this->getIdMd($productId)) {
                        if ($this->compareQuantityProduct($this->productService->getProduct($productId), $item['quantity'])) {
                            return;
                        }
                        $this->set($productId, $quantity);
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

        if ($this->compareQuantityProduct($this->productService->getProduct($productId), $cardItems->quantity)) {
            return;
        }

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

    public function set($productId, $quantity): void
    {
        if (!auth()->user()) {
            $this->loadItems();
            foreach ($this->items as $i => $item) {
                if ($item['id'] == $this->getIdMd($productId)) {
                    $this->items[$i]['quantity'] += $quantity;
                    $this->saveItems();
                    return;
                }
            }
            throw new \DomainException('Item is not found.');
        }
    }


    public function update($product, $quantity)
    {


        if ($quantity == 0) {
            $quantity = 1;
        }

        if (!auth()->user()) {
            $items = \Session::get('cart', []);

            $items[] = [
                'id' => $this->getIdMd($product->id),
                'product' => $product,
                'quantity' => $quantity
            ];


            $this->loadItems();
            if ($this->items) {
                foreach ($this->items as $i => $item) {
                    if ($item['id'] == $this->getIdMd($product->id)) {
                        if ($this->compareQuantityProduct($product, $quantity)) {
                            return;
                        }
                        $this->setUpdate($product->id, $quantity);
                        return;
                    }
                }
            }
            \Session::put('cart', $items);
        } else {
            $this->updateItemsCartDB($product, $quantity);
        }

    }

    public function updateItemsCartDB($product, $quantity){

        if (!$product) { return; }

        $cardItems = $this->cart->where([
            ['user_id', '=', auth()->id()],
            ['product_id', '=', $product->id],
        ])->first();

        if ($this->compareQuantityProduct($product, $quantity)) {
            return;
        }

        if ($cardItems) {
            $cardItems->update([
                'quantity' => $quantity
            ]);

        } else {
            $cartItem = $this->cart->make([
                'product_id' => $product->id,
                'quantity' => $quantity
            ]);
            $cartItem->user()->associate(auth()->user());
            $cartItem->saveOrFail();
        }
    }

    public function setUpdate($productId, $quantity): void
    {

        if (!auth()->user()) {
            $this->loadItems();
            foreach ($this->items as $i => $item) {
                if ($item['id'] == $this->getIdMd($productId)) {
                    $this->items[$i]['quantity'] = $quantity;
                    $this->saveItems();
                    return;
                }
            }
            throw new \DomainException('Item is not found.');
        }
    }

    // Проверка наличия товара
    public function compareQuantityProduct($product, $quantity)
    {
        if ($product->quantity >= $quantity && $product->quantity > 1) {
            return;
        } throw new \DomainException('Товар в наличии '. $product->quantity .' шт.');

    }

    // Обновление количества товара в корзине
    public function compareUpdateQuantityProduct($product, $quantity)
    {

        if (!auth()->user()) {
            $items = \Session::get('cart', []);

            $items[] = [
                'id' => $this->getIdMd($product->id),
                'product' => $product,
                'quantity' => $quantity
            ];


            $this->loadItems();
            if ($this->items) {
                foreach ($this->items as $i => $item) {
                    if ($item['id'] == $this->getIdMd($product->id)) {
                        if ($this->compareQuantityProduct($product, $item['quantity'])) {
                            return;
                        }
                        $this->update($product->id, $quantity);
                        return;
                    }
                }
            }
            \Session::put('cart', $items);
        } else {
            $this->addItemsCartDB($product->id, $quantity);
        }

    }


    public function removeOneQuantityProduct($id) {
        if (!auth()->user()) {
            $this->loadItems();
            foreach ($this->items as $i => $item) {
                if ($item['id'] == $this->getIdMd($id)) {
                    if ($this->compareQuantityProduct($this->productService->getProduct($id), $item['quantity'])) {
                        return;
                    }
                    $this->items[$i]['quantity'] -= 1;
                    $this->saveItems();
                    return;
                }
            }
        } else {
            $user = auth()->user();
            $cartItem = $cartItem = Cart::where([
                ['user_id', '=', $user->id],
                ['product_id', '=', $id],
            ])->first();


            if ($cartItem) {
                $cartItem->update([
                    'quantity' => $cartItem->quantity -= 1,
                ]);
            }
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
        } else {
            $user = auth()->user();
            $cartItem = $cartItem = Cart::where([
                ['user_id', '=', $user->id],
                ['product_id', '=', $id],
            ])->first();

            if ($cartItem) {
                $cartItem->delete();
            }
        }
    }

    public function clear ($cartItems) {

        foreach ($cartItems as $item) {
            if (auth()->user()) {
                $this->remove($item->product_id);
            } session()->forget('cart');
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

                if ($this->compareQuantityProduct($this->productService->getProduct($item['product']->id), $item['quantity'])) {
                    return;
                }

                if ($cartItem) {

                    if ($cartItem->quantity + $item['quantity'] > $this->productService->getProduct($item['product']->id)->quantity) {
                        return;
                    }

                    $cartItem->update([
                        'quantity' => $cartItem->quantity + $item['quantity']
                    ]);

                } else {
                    if ($this->compareQuantityProduct($this->productService->getProduct($item['product']->id), $item['quantity'])) {
                        return;
                    }
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
