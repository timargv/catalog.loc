<?php
/**
 * Created by PhpStorm.
 * User: Pauk
 * Date: 21.04.2019
 * Time: 12:59
 */

namespace App\UseCases\Attribute;


use App\Entity\Shop\Product\Value;

class ValueService
{

    protected $value;

    public function __construct(Value $value)
    {
        $this->value = $value;
    }

    /**
     * @return Value
     */
    public function getValue(): Value
    {
        return $this->value;
    }


    public function createAttributeValue ($value_name)
    {
        $value = $this->value->create([
            'value' => $value_name,
        ]);

        return $value;
    }
}
