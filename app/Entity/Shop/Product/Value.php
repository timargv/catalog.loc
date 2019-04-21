<?php

namespace App\Entity\Shop\Product;

use App\Entity\Product;
use App\Entity\Shop\Attribute\Attribute;
use App\Entity\Shop\Attribute\AttributeData;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property mixed $attribute
 * @property mixed $products
 */
class Value extends Model
{
    protected $table = 'attribute_values';
    protected $fillable = ['value'];

    public function product() {
        return $this->belongsTo(AttributeData::class, 'value_id');
    }



}
