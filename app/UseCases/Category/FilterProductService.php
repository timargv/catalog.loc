<?php
/**
 * Created by PhpStorm.
 * User: Jo
 * Date: 18.04.2019
 * Time: 14:12
 */

namespace App\UseCases\Category;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Shop\Attribute\Attribute;
use App\Entity\Shop\Product\Value;
use mysql_xdevapi\Collection;

class FilterProductService
{

    protected $attribute;
    protected $product;
    protected $value;

    public $products;

    public function __construct(Attribute $attribute, Product $product, Value $value)
    {
        $this->attribute = $attribute;
        $this->product = $product;
        $this->value = $value;

    }

    public function filter ($request, $category)
    {

        $attributes = $this->getAttributes($request->all(), $category);
        dd($attributes);



    }


    public function getAttributes ($request, $category) {
        $attributeIds = [];

        $products = $category->where('id', $category->id)->products()->get();


        dd($products);
    }

    public function getValues ($attributeIds) {

        $values = $this->value->whereIn('attribute_id', $attributeIds)->get();
        return $values;
    }


    public function getProducts($category)
    {
        return $category->products()->with('values')->get();
    }

    /**
     * @return Attribute
     */
    public function getAttribute($slug)
    {
        return $this->attribute->where('slug', $slug)->first();
    }

    public function getCategory($category)
    {
        return Category::findOrFail($category->id);
    }

}
