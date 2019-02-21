<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //
    protected $table = 'brands';
    protected $fillable = ['title', 'slug'];
}
