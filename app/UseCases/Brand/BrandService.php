<?php
/**
 * Created by PhpStorm.
 * User: Jo
 * Date: 12.03.2019
 * Time: 13:04
 */

namespace App\UseCases\Brand;


use App\Entity\Brand;
use function GuzzleHttp\Psr7\str;

class BrandService
{
    public function firstOrCreateBrand ($name) {

        $brand = Brand::firstOrCreate(
            ['title' => $name], ['slug' => str_slug($name)]
        );

        $brand->saveOrFail();
        return $brand;
    }
}