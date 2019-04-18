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

    public function __construct(Attribute $attribute, Product $product)
    {
        $this->attribute = $attribute;
        $this->product = $product;

    }

    public function filter ($request, $category)
    {

        $product_filer_collect = [];

        foreach ($request->all() as $key => $item) {
            $products = $category->products()->with('values')->get();

            $all_products = [];

            foreach ($products as $key => $product) {

                if(!empty($product_is = $products[$key]->values()->where('value', '=', $item)->first())) {
                    $all_products[] = $product_is->product->with('values')->first();

                }
            }
            dd($all_products);


        }

        dd($product_filer_collect);
//        $products = collect($product_filer_collect);
//        dd($products);
        return $products;
    }

}