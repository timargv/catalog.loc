<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class Currency extends Model
{
    //
    protected $table = 'currencies';
    protected $fillable = ['currency'];
}
