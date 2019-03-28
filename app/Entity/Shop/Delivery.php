<?php

namespace App\Entity\Shop;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class Delivery extends Model
{
    protected $table    = 'deliveries';
    protected $fillable = ['title', 'cost','min_weight','max_weight','sort'];

}
