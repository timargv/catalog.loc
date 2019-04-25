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

class FilterProductService
{

    protected $attribute;
    protected $product;
    protected $value;

    public function __construct(Attribute $attribute, Product $product, Value $value)
    {
        $this->attribute = $attribute;
        $this->product = $product;
        $this->value = $value;

    }

    public function filter ($request, $category)
    {

        $product_filer_collect = null;
        $productsListIds = $category->products()->pluck('id');
        $productsLists = $category->products()->get();

        $result = [];

        foreach ($request->all() as $key => $item) {
                $attribute = $this->attribute->where('slug', $key)->first();
                $productIds = $attribute->values()->whereIn('value', $item)->pluck('product_id');
        }


        $products = $category->products()->whereIn('id', $productIds)->paginate(16);

        return $products;
    }

}