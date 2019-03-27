<?php

namespace App\Entity\Shop\Product;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class PriceHistory extends Model
{
    protected $table = 'product_price_history';
    protected $fillable = ['product_id', 'price', 'vendor_price'];
}
