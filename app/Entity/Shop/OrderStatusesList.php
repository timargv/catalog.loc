<?php

namespace App\Entity\Shop;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class OrderStatusesList extends Model
{
    protected $table = 'order_statuses_lists';
    protected $fillable = ['title', 'color'];

}
