<?php

namespace App\Entity\Shop\Product;

use App\Entity\Shop\Attribute\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property mixed $attribute
 */
class Value extends Model
{
    protected $table = 'product_attribute_values';

    public $timestamps = false;

    protected $fillable = ['attribute_id', 'value'];

    //------------------- Атрибуты
    public function attribute() {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
