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
        $productsListIds = $category->products()->pluck('id')->all();

//        $attribute = [];
        $result = [];
        foreach ($request->all() as $key => $item) {
            $attribute[] = $this->attribute->where('slug', $key)->with('values')->first();
            $result[] = $attribute[0]->values()->where('value', $item)->get();

        }


        if (!empty($result)) {
            foreach ($result as $item) {
                $productIds = $item->whereIn('product_id', $productsListIds);
            }
        }


        $products = Product::whereIn('id', $productIds)->with('photos')->paginate(16);

        return $products;
    }

}