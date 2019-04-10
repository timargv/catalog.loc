<?php

namespace App\Entity\Shop\Widgets;

use App\Entity\Category;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $category
 * @property int $id
 */
class WidgetCategoryItem extends Model
{
    protected $table = 'widget_category_items';
    protected $fillable = ['widget_id', 'category_id', 'sort'];

    public $timestamps = false;

    //-------------
    public function category ()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
