<?php
/**
 * Created by PhpStorm.
 * User: Pauk
 * Date: 21.04.2019
 * Time: 13:01
 */

namespace App\UseCases\Attribute;


use App\Entity\Shop\Attribute\Attribute;
use App\Entity\Shop\Attribute\AttributeData;

class AttributeService
{

    protected $attribute;
    protected $attributeData;

    public function __construct(Attribute $attribute, AttributeData $attributeData)
    {
        $this->attribute = $attribute;
        $this->attributeData = $attributeData;
    }



    public function createAttributeData ($attributeId, $productId, $valueId)
    {
        $attributeData =  $this->attributeData->firstOrCreate([
            'attribute_id' => $attributeId,
            'product_id' => $productId,
            'value_id' => $valueId
        ]);

        return $attributeData;
    }
}
