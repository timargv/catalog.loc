<?php
/**
 * Created by PhpStorm.
 * User: Jo
 * Date: 21.02.2019
 * Time: 10:30
 */

namespace App\UseCases\Product;


use App\Entity\Shop\Product\Photo;
use Illuminate\Support\Facades\Storage;

class PhotoService
{

    private function getPhoto($id): Photo
    {
        return Photo::findOrFail($id);
    }

    public function removePhoto($id): void
    {
        $photo = $this->getPhoto($id);
        $photo->delete();
        Storage::disk('public')->delete($photo->file);
    }

}