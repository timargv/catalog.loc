<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $table = 'contacts';

    protected $fillable = [
        'name',
        'surname',
        'mobile_phone',
        'office_phone',
        'office_phone_dop',
        'email',
        'slug',
        'shipper_id',
        'shipper_other',
        'comment',
        'function'
    ];

    public function shipper () {
        return $this->belongsTo(Shipper::class);
    }
}
