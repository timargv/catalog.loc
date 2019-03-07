<?php

namespace App\Entity\Shop\Attribute;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property mixed $attributes
 */
class AttributeGroup extends Model
{
    protected $table = 'attribute_groups';
    protected $fillable = ['name', 'sort','slug'];

    public function attributes()
    {
        return $this->hasMany(Attribute::class, 'group_id', 'id');
    }


}
