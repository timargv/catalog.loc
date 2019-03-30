<?php

namespace App\Entity\Shop;

use App\Entity\Product;
use App\UseCases\Cart\CartService;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property mixed $products
 * @property mixed $product
 * @property mixed $service
 */
class Cart extends Model
{
    protected $table = 'carts';
    protected $fillable = ['user_id', 'product_id', 'quantity'];


    //------------------- Товыра в заказе
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->with('photos', 'vendor');
    }

    //------------------- Пользователь
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public static function count() : int {
        $count = 0;
        if (!auth()->user()) {
            $items = session()->get('cart');

           if ($items) {
               foreach ($items as $item) {
                   $count += $item['quantity'];
               }
           }
            return $count;
        } else {
            $cartItems = self::where('user_id', auth()->id())->get();

            foreach ($cartItems as  $item) {
                $count += $item['quantity'];
            }
            return $count;
        }

    }


    public function getGroup($cartItems) {


        $cartItemsCollection = collect($cartItems);


        $cartGroup = $cartItemsCollection->groupBy(function ($item, $key) {
            return $item->user_id;
        });

        return $cartGroup;

    }


    public function getUser($id) : User {

        return User::findOrFail($id);
    }



}
