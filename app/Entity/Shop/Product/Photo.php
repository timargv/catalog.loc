<?php

namespace App\Entity\Shop\Product;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 */
class Photo extends Model
{

    protected $table = 'product_photos';
    public $timestamps = false;
    protected $fillable = ['file', 'sort', 'type'];

    public const STATUS_MAIN_PHOTO = 'yeas';
    public const STATUS_NOT_MAIN_PHOTO = 'no';

    public function photoMain(): void
    {
        $this->update([
            'type' => self::STATUS_MAIN_PHOTO,
        ]);
    }

    public function isDraftPhotoMain()
    {
        dd('ss');
        $this->update([
            'type' => self::STATUS_NOT_MAIN_PHOTO,
        ]);
    }
}
