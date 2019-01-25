<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

    protected $table = 'products';

    //-------------------
    public function categories () {
        return $this->belongsToMany(Category::class,'product_categories','product_id','category_id');
    }
}
