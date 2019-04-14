<?php

namespace App\Entity\Shop\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;


/**
 * @property int $id
 */
class Photo extends Model
{

    protected $table = 'product_photos';
    public $timestamps = false;
    protected $fillable = ['file', 'sort', 'main'];

    public const STATUS_MAIN_PHOTO = 'yeas';
    public const STATUS_NOT_MAIN_PHOTO = 'no';

    public function photoMain(): void
    {
        $this->update([
            'main' => self::STATUS_MAIN_PHOTO,
        ]);
    }

    public function isDraftPhotoMain()
    {
        $this->update([
            'main' => self::STATUS_NOT_MAIN_PHOTO,
        ]);
    }

    public function getSize()
    {
        $photo = Storage::disk('public')->size('\products\original\\'. $this->file);
        $fileSize = self::bytesToHuman($photo);
        return $fileSize;
    }


    public static function bytesToHuman($bytes)
    {
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }
}
