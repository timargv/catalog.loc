<?php

namespace App\Entity\Shop\Widgets;

use App\Entity\Product;
use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    protected $table = 'widgets';
    protected $fillable = ['title'];

    //-------------------
    public function widgetProductItems () {
        return $this->hasMany(WidgetProductItem::class,'widget_id')->with('product');
    }



    public function hasInWidgetProductItems($id): bool
    {
        return $this->widgetProductItems()->where('product_id', $id)->exists();
    }

    public function getProducts() {
        return $this->widgetProductItems()->get();
    }
}
