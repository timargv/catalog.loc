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
        return $this->belongsToMany(Product::class,'widget_product_items','widget_id','product_id');
    }

    public function setProducts($ids)
    {
        if($ids == null){return;}
        $this->widgetProductItems()->sync($ids);
    }

    public function addProduct($ids)
    {
        foreach ($ids as $id) {
            if ($this->hasInWidgetProductItems($id)) {
                throw new \DomainException('Этот товар уже добавлен.');
            }
            $this->widgetProductItems()->attach($id);
        }
    }

    public function hasInWidgetProductItems($id): bool
    {
        return $this->widgetProductItems()->where('product_id', $id)->exists();
    }

    public function getProducts() {
        return $this->widgetProductItems()->get();
    }
}
