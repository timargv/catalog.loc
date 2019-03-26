<?php

namespace App\Entity;

use App\Entity\Shop\Attribute\Attribute;
use App\Entity\Shop\Attribute\AttributeGroup;
use App\Entity\Shop\Product\Photo;
use App\Entity\Shop\Product\Value;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * @property mixed $categories
 * @property mixed $vendor
 * @property mixed $currency
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property mixed $category
 * @property mixed $author
 * @property mixed $brand
 * @property mixed $values
 * @property mixed available
 * @property mixed $photos
 * @property mixed vendor_code
 * @property mixed $attributes
 * @property mixed $group_name
 */
class Product extends Model
{
    //
    protected $table = 'products';

    protected $fillable = [
        'available',
        'status',
        'original_id',
        'original_url',
        'name',
        'name_original',
        'price',
        'vendor_price',
        'picture',
        'vendor_code',
        'vendor_code_original',
        'sh_desc',
        'desc',

        'type_packaging',
        'packing_dimensions',
        'length',
        'width',
        'height',
        'barcode',
        'weight',
        'slug',

        'user_id',
        'brand_id',
        'vendor_id',
        'category_id',
    ];


    public const STATUS_ACTIVE = 'active';
    public const STATUS_CLOSED = 'disabled';

    public const AVAILABLE_TRUE = 'yeas';
    public const AVAILABLE_FALSE = 'no';

    public const STATUS_MAIN_PHOTO = 'yeas';
    public const STATUS_NOT_MAIN_PHOTO = 'no';


    // Статус В наличии или нет
    public static function statusesAvailable(): array
    {
        return [
            self::AVAILABLE_TRUE => 'Есть',
            self::AVAILABLE_FALSE => 'Нет',
        ];
    }

    // Статус товара активен или нет
    public static function statusesList(): array
    {
        return [
            self::STATUS_ACTIVE => 'Влючить',
            self::STATUS_CLOSED => 'Отключить',
        ];
    }

    // Статус картинки Товара Основная или нет
    public static function statusesMainPhoto(): array
    {
        return [
            self::STATUS_MAIN_PHOTO => 'Да',
            self::STATUS_NOT_MAIN_PHOTO => 'Нет',
        ];
    }

    //------------------- Категории
//    public function categories() {
//        return $this->belongsToMany(Category::class,'product_categories','product_id','category_id');
//    }

    //------------------- Категории
    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    //------------------- Поставщик
    public function vendor() {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    //------------------- Валюта
    public function currency() {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    //------------------- Бренд
    public function brand() {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    //------------------- Автор
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //------------------- Значения Атрибутов
    public function values()
    {
        return $this->hasMany(Value::class, 'product_id');
    }

    //------------------- Фотография
    public function photos()
    {
        return $this->hasMany(Photo::class, 'product_id');
    }


    //------------------- Добавление в Промежуточную таблицу
    public function setCategories($ids)
    {
        if ($ids === null) { return; }
        $this->categories()->sync($ids);
    }

    public function getCategoryTitle()
    {
        return ($this->category != null) ? $this->category->name : 'Нет категории';
    }


    public function getStatusesAvailable()
    {
        return ($this->available == self::AVAILABLE_TRUE) ? 'Есть' : 'Нет';
    }

    public function getVendorTitle()
    {
        return ($this->vendor != null) ? $this->vendor->title : '';
    }

    public function getVendorId()
    {
        return ($this->vendor != null) ? $this->vendor->id : '';
    }

    public function getValue($id)
{
    foreach ($this->values as $value) {
        if ($value->attribute_id === $id) {
            return $value->value;
        }
    }
    return null;
}

    public function getGroupNameAttribute($id)
    {
        return AttributeGroup::findOrFail($id);
    }

    public function getMainphoto()
    {
        $photos = $this->photos()->where('main', self::STATUS_MAIN_PHOTO)->take(1)->get();
        return $photos;
    }

    public function getGroup($attributes) {


        $attributesCollection = collect($attributes)->where('status', 1);


        $group = $attributesCollection->groupBy(function ($item, $key) {
            return $item->group_id;
        });

//        dd($group);
        return $group;

    }

    //    COUNTS
    public static function count()
    {
        return Cache::remember('count_products', 60, function () {
            return static::query()->count();
        });
    }

}
