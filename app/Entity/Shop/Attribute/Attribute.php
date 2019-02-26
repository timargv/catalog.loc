<?php

namespace App\Entity\Shop\Attribute;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Shop\Product\Value;
use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property mixed $group
 * @property array $variants
 * @property mixed type
 * @property mixed $attribute_group
 * @property mixed $categories
 */
class Attribute extends Model
{

    const TYPE_STRING = 'string';
    const TYPE_INTEGER = 'integer';
    const TYPE_FLOAT = 'float';

    protected $table = 'attributes';
    protected $fillable = ['name', 'group_id', 'type', 'required', 'variants', 'sort', 'slug'];

    protected $casts = [
        'variants' => 'array',
    ];


    public function group()
    {
        return $this->belongsTo(AttributeGroup::class, 'group_id', 'id');
    }

    public function categories() {
        return $this->belongsToMany(Category::class,'attributes_categories','attribute_id','category_id');
    }

    public function products() {
        return $this->belongsToMany(Product::class,'product_attribute_values','attribute_id','product_id');
    }

    public function values() {
        return $this->hasMany(Value::class, 'attribute_id', 'id');
    }


    public static function typesList(): array
    {
        return [
            self::TYPE_STRING => 'String',
            self::TYPE_INTEGER => 'Integer',
            self::TYPE_FLOAT => 'Float',
        ];
    }

    public function isString(): bool
    {
        return $this->type === self::TYPE_STRING;
    }

    public function isInteger(): bool
    {
        return $this->type === self::TYPE_INTEGER;
    }

    public function isFloat(): bool
    {
        return $this->type === self::TYPE_FLOAT;
    }

    public function isNumber(): bool
    {
        return $this->isInteger() || $this->isFloat();
    }

    public function isSelect(): bool
    {
//        print_r(count($this->variants));
        return \count($this->variants) > 0;
    }

    public function setCategories($ids)
    {
        if ($ids === null) { return; }
        $this->categories()->sync($ids);
    }


}
