<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Vendor extends Model
{
    protected $table = 'vendors';
    protected $fillable = ['title', 'url', 'email', 'number', 'address', 'code_product', 'comment', 'slug'];


    //------------------------
    public function contact(){
        return $this->hasMany(Contact::class, 'shipper_id');
    }


    //------------------------
    public function products()
    {
        return $this->hasMany(Product::class, 'vendor_id');
    }


    //    COUNTS
    public static function count()
    {
        return Cache::remember('count_vendors', 60, function () {
            return static::query()->count();
        });
    }
}
