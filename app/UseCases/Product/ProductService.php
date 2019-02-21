<?php

namespace App\UseCases\Product;


use App\Entity\Product;
use App\Entity\Shop\Product\Photo;
use App\Http\Requests\Admin\Product\PhotosRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductService
{
    public function addPhotos($id, PhotosRequest $request): void
    {
        $product = $this->getProduct($id);

        DB::transaction(function () use ($request, $product) {

            $path = public_path().'\storage\products\original\\';
            $thumbPath = public_path().'\storage\products\thumbnail\\';
            $middlePath = public_path().'\storage\products\middle\\';
            $largePath = public_path().'\storage\products\large\\';

            foreach ($request['files'] as $file) {

                $img = Image::make($file);
                if (!file_exists($path) && !file_exists($thumbPath) && !file_exists($middlePath)  && !file_exists($largePath)) {
                    mkdir($path, 666, true);
                    mkdir($thumbPath, 666, true);
                    mkdir($middlePath, 666, true);
                    mkdir($largePath, 666, true);
                }
                $img->save($path . $file->getClientOriginalName());
                $img->resize(320, 240)->save($thumbPath . $file->getClientOriginalName());
                $img->resize(450, 450)->save($middlePath . $file->getClientOriginalName());
                $img->resize(1000, 1000)->save($largePath .$file->getClientOriginalName());

                $product->photos()->create([
                    'file' => $file->getClientOriginalName(),
                    'sort' => 1
                ]);
            }
            $product->update();

        });
    }

    private function getProduct($id): Product
    {
        return Product::findOrFail($id);
    }

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

    public function removePhotos($product)
    {

        dd($product);

        foreach ($product->photos() as $photo) {
            dd($photo);
            $photo = $this->getPhoto($photo->id);
            $photo->delete();
            Storage::disk('public')->delete($photo->file);
        }
    }

    public function isMainPhoto($product, $id) {
        $product = $this->getProduct($product);

        $product->photos()->update([
            'type' => Photo::STATUS_NOT_MAIN_PHOTO
        ]);

        $photoItem = $this->getPhoto($id);
        $photoItem->photoMain();
    }

}