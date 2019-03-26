<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Brand extends Model
{
    //
    protected $table = 'brands';
    protected $fillable = ['title', 'slug'];

    //    COUNTS
    public static function count()
    {
        return Cache::remember('count_vendors', 60, function () {
            return static::query()->count();
        });
    }
}
