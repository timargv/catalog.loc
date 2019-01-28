<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;

    protected $table = 'categories';

    public const STATUS_ACTIVE = 'active';
    public const STATUS_CLOSED = 'disabled';

    protected $fillable = [
        'name',
        'name_original',
        'name_h1',
        'description',
        'status',
        'code',
        'count',
        'image',
        'parent_id',
        'icon',
        'slug'
    ];


    //-------------------
    public function products () {
        return $this->belongsToMany(Product::class,'product_categories','category_id','product_id');
    }


    public function setDraft()
    {
        $this->status = self::STATUS_CLOSED;
        $this->save();
    }

    public function setPublic()
    {
        $this->status = self::STATUS_ACTIVE;
        $this->save();
    }

    public function toggleStatus($value)
    {
        if($value == null)
        {
            return $this->setDraft();
        }

        return $this->setPublic();
    }
}
