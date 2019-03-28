<?php

namespace App\Entity\Shop;

use App\Entity\Product;
use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property mixed $products
 * @property mixed $product
 */
class Cart extends Model
{
    protected $table = 'carts';
    protected $fillable = ['user_id', 'product_id', 'quantity'];

    //------------------- Товыра в заказе
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}