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

<<<<<<< HEAD
    public $products;

    public function __construct(Attribute $attribute, Product $product, Value $value)
=======
    public function __construct(Attribute $attribute, Product $product)
>>>>>>> parent of 052c729... update
    {
        $this->attribute = $attribute;
        $this->product = $product;

    }

    public function filter ($request, $category)
    {

<<<<<<< HEAD
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

=======
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
>>>>>>> parent of 052c729... update

    public function getProducts($category)
    {
        return $category->products()->with('values')->get();
    }

<<<<<<< HEAD
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
=======
        }

        dd($product_filer_collect);
//        $products = collect($product_filer_collect);
//        dd($products);
        return $products;
>>>>>>> parent of 052c729... update
    }

}
