<?php

namespace App\Entity\Shop\Widgets;

use App\Entity\Category;
use App\Entity\Product;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $categories
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property mixed type
 * @property mixed status
 */
class Widget extends Model
{
    public const OPTION_PRODUCT_DISCOUNTED = 'discounted';

    public const TYPE_PRODUCT = 'products';
    public const TYPE_CATEGORY = 'category';

    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'in_active';


    protected $table = 'widgets';
    protected $fillable = ['title', 'status', 'type', 'option'];



    // Статус
    public static function statusesAvailable(): array
    {
        return [
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_INACTIVE => 'Выключен',
        ];
    }

    // Type widget list
    public static function typesList(): array
    {
        return [
            self::TYPE_PRODUCT => 'Product',
            self::TYPE_CATEGORY => 'Category',
        ];
    }

    // Option widget list
    public static function optionsList(): array
    {
        return [
            self::OPTION_PRODUCT_DISCOUNTED => 'DISCOUNTED',
        ];
    }

    //-------------------
    public function widgetProductItems () {
        return $this->hasMany(WidgetProductItem::class,'widget_id')->with('product');
    }

    //-------------------
    public function widgetCategoryItems () {
        return $this->hasMany(WidgetCategoryItem::class,'widget_id')->with('category');
    }

    //-------------------
    public function categories ()
    {
        return $this->belongsToMany(
            Category::class,
            'widget_categories',
            'category_id',
            'widget_id');
    }




    public function hasInWidgetProductItems($id): bool
    {
        return $this->widgetProductItems()->where('product_id', $id)->exists();
    }

    public function getProducts()
    {
        return $this->widgetProductItems()->get();
    }


    public function isTypeProduct(): bool
    {
        return $this->type === self::TYPE_PRODUCT;
    }

    public function isTypeCategory(): bool
    {
        return $this->type === self::TYPE_CATEGORY;
    }


    public function getTypeName() : string
    {
        if (array_key_exists($this->type, self::typesList())) {
            return self::typesList()[$this->type];
        } return '';
    }

    public function getStatusName() : string
    {
        if (array_key_exists($this->status, self::statusesAvailable())) {
            return self::statusesAvailable()[$this->status];
        } return '';
    }
}
