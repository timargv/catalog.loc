<?php
/**
 * Created by PhpStorm.
 * User: Pauk
 * Date: 10.04.2019
 * Time: 19:01
 */

namespace App\UseCases\Product;


use App\Entity\Product;
use App\Http\Requests\Product\SearchRequest;
use Illuminate\Support\Facades\DB;

class SearchService
{

    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }


    public function search(SearchRequest $request) {

        $value = $request->get('text');

        return $this->product
                ->where('name_original', 'like', '%' . $value . '%')
                ->orWhere('name', 'like', '%' . $value . '%')->orderBy('id', 'DESC')->with('photos')->paginate(15);        
    }
}
