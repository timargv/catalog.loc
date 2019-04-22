<?php

namespace App\Entity\Shop\Attribute;

use App\Entity\Product;
use App\Entity\Shop\Product\Value;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $value
 */
class AttributeData extends Model
{
    protected $table = 'attributes_data';

    protected $fillable = ['attribute_id', 'product_id', 'value_id'];


//    public function product() {
//        return $this->belongsTo(Product::class, 'product_id');
//    }
//
//    public function attribute() {
//        return $this->belongsTo(Attribute::class, 'attribute_id');
//    }
//
////
//    public function value() {
//        return $this->belongsTo(Value::class, 'value_id');
//    }


    public function createAttributeData ($attributeId, $productId, $valueId)
    {
        $attributeData =  $this->create([
            'attribute_id' => $attributeId,
            'product_id' => $productId,
            'value_id' => $valueId
        ]);

        return $attributeData;
    }

}
