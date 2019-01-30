<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Shipper extends Model
{
    //

    protected $table = 'shippers';

    protected $fillable = ['title', 'url', 'email', 'number', 'address', 'code_product', 'comment', 'slug'];


    //------------------------
    public function contact(){
        return $this->hasMany(Contact::class, 'shipper_id');
    }


    //------------------------
    public function product()
    {
        return $this->hasMany(Product::class, 'manufacturer_id');
    }
}
