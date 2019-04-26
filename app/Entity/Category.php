<?php

namespace App\Entity;

use App\Entity\Shop\Attribute\Attribute;
use App\Entity\Shop\Attribute\AttributeGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Kalnoy\Nestedset\NodeTrait;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property mixed $products
 * @property mixed $parent
 * @property mixed $attributes
 */
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
        'meta_description',
        'meta_title',
        'meta_keywords',
        'description',
        'status',
        'code',
        'count',
        'image',
        'parent_id',
        'shipper_id',
        'icon',
        'slug'
    ];


    //-------------------
    public function products () {
//        return $this->belongsToMany(Product::class,'product_categories','category_id','product_id');
        return $this->hasMany(Product::class,'category_id','id')->where('status', self::STATUS_ACTIVE)->with('photos');
    }

    public function parent()
    {
        return $this->belongsTo(self::class)->with('parent');
    }

    public function parentAttributes(): array
    {
        return $this->parent ? $this->parent->allAttributes() : [];
    }

    /**
     * @return Attribute[]
     */
    public function allAttributes(): array
    {
//        $result = array_merge($this->parentAttributes(), $this->attributes()->orderBy('sort')->getModels());
//        dd($result);
        $result =  $this->attributes()->orderBy('sort')->getModels();
        return $result;
    }

    public function allAttributesFilter(): array
    {
//        $result = array_merge($this->parentAttributes(), $this->attributes()->orderBy('sort')->getModels());
//        dd($result);
        $result =  $this->attributes()->where([
            ['status', 1],
            ['visibility', 1]
        ])->orderBy('sort')->getModels();
        return $result;
    }

    public function allAttributesFilterVisual(): array
    {
        $result =  $this->allAttributesGetAll()->where([
            ['status', 1],
            ['is_filter', 1],
            ['visibility', 1],
        ])->orderBy('sort')->getModels();
        return $result;
    }

    public function attributes()
    {
        return $this->belongsToMany(
            Attribute::class,
            'attributes_categories',
            'category_id',
            'attribute_id'
        )->where('visibility', 1);
    }

    public function allAttributesGet()
    {
        return $this->belongsToMany(
            Attribute::class,
            'attributes_categories',
            'category_id',
            'attribute_id'
        )->where('visibility', 1);
    }

    public function allAttributesGetAll()
    {
        return $this->belongsToMany(
            Attribute::class,
            'attributes_categories',
            'category_id',
            'attribute_id'
        );
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

    public static function count()
    {
        return Cache::remember('count_categories', 60, function () {
            return static::query()->count();
        });
    }

    // Группировка Атрибутов
    public function getGroupAttributesValue($attributes) {

        $attributesCollection = collect($attributes);


        $group = $attributesCollection->groupBy(function ($item, $key) {
            if (!empty($item[$key])) {
                return $item[$key]->attribute()->where('id', $item[$key]->attribute_id)->first()->name;
            }

        });

//        dd($group);
//        dd(unset($group->items[""]));
        return $group;
    }


    public function getValuesFilter()
    {
        $attributes = $this->allAttributesFilterVisual();

        $productIds = $this->products()->pluck('id');

        $value = [];

        foreach ($attributes as $key => $attribute) {
            if (!empty($attribute_get = $attribute->values()->whereIn('product_id', $productIds)->get())) {
                $value[$key] = $attribute_get;
            }
        }

        return $this->getGroupAttributesValue($value);
    }

    // Найти группу атрибутов по ID
    public function getNameAttributeValue($id)
    {
        if ($id == null) { return; }
        return $this->attributes()->findOrFail($id);
    }

    public function getFilterValueUniqArray($values): array
    {

        $arr = $values[0]->sortBy('value')->groupBy('value')->toArray();
        return $arr;
    }


}
