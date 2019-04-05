<?php

namespace App\Entity\Shop\Widgets;

use App\Entity\Product;
use Illuminate\Database\Eloquent\Model;

class WidgetProductItem extends Model
{
    protected $table = 'widget_product_items';
    protected $fillable = ['widget_id', 'product_id', 'sort'];

    public $timestamps = false;

    public function product ()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
