<?php

namespace App\Entity\Shop\Product;

use App\Entity\Product;
use App\Entity\Shop\Attribute\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property mixed $attribute
 * @property mixed $products
 */
class Value extends Model
{
    protected $table = 'product_attribute_values';

    public $timestamps = false;

    protected $fillable = ['product_id', 'attribute_id', 'value'];

    //------------------- Атрибуты
    public function attribute() {
        return $this->belongsTo(Attribute::class, 'attribute_id')->where('is_filter', 1);
    }

    //------------------- Атрибуты


    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
