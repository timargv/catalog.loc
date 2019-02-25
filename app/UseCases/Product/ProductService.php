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

    public function pathPhoto()
    {
        $paths = [
            'original' => public_path() . '\storage\products\original\\',
            'thumbnail' => public_path() . '\storage\products\thumbnail\\',
            'small' => public_path() . '\storage\products\small\\',
            'medium' => public_path() . '\storage\products\medium\\',
            'large' => public_path() . '\storage\products\large\\',
        ];
        return $paths;
    }
    

    public function addPhotos($id, PhotosRequest $request): void
    {
        $product = $this->getProduct($id);

        DB::transaction(function () use ($request, $product) {
            $path = $this->pathPhoto()['original'];
            $thumbPath = $this->pathPhoto()['thumbnail'];
            $smallPath = $this->pathPhoto()['small'];
            $middlePath = $this->pathPhoto()['medium'];
            $largePath = $this->pathPhoto()['large'];

            $productPhotos = $product->photos()->count();

             foreach ($request['files'] as $key => $file) {

                $img = Image::make($file);
                if (!file_exists($path) && !file_exists($thumbPath) && !file_exists($smallPath) && !file_exists($middlePath) && !file_exists($largePath)) {
                    mkdir($path, 666, true);
                    mkdir($thumbPath, 666, true);
                    mkdir($smallPath, 666, true);
                    mkdir($middlePath, 666, true);
                    mkdir($largePath, 666, true);
                }

                $fileName = $product->id.'-'.uniqid().'-'. (new \DateTime)->getTimeStamp() . '.png';

                $img->save($path . $fileName);
                $img->resize(80, 80)->save($thumbPath . $fileName);
                $img->resize(320, 320)->save($thumbPath . $fileName);
                $img->resize(150, 150)->save($smallPath . $fileName);
                $img->resize(450, 450)->save($middlePath . $fileName);
                $img->resize(1000, 1000)->save($largePath .$fileName);

                if ($key == 0) {
                    $product->photos()->create([
                        'file' => $fileName,
                        'sort' => 1,
                        'main' =>  $productPhotos == 0 ? 'yeas' : 'no',
                    ]);
                } else {
                    $product->photos()->create([
                        'file' => $fileName,
                        'sort' => 1,
                        'main' => 'no',
                    ]);
                }


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
        Storage::disk('public')->delete([
            '\products\original\\'.$photo->file,
            '\products\thumbnail\\'.$photo->file,
            '\products\small\\'.$photo->file,
            '\products\medium\\'.$photo->file,
            '\products\large\\'.$photo->file,
        ]);
    }

    public function removePhotos($id)
    {
        $product = $this->getProduct($id);
        $photos = $product->photos()->get();

        foreach ($photos as $photo) {
            Storage::disk('public')->delete([
                '\products\original\\'.$photo->file,
                '\products\thumbnail\\'.$photo->file,
                '\products\small\\'.$photo->file,
                '\products\medium\\'.$photo->file,
                '\products\large\\'.$photo->file,
            ]);
        }
        $product->photos()->delete();
    }

    public function isMainPhoto($product, $id) {
        $product = $this->getProduct($product);

        $product->photos()->update([
            'main' => Photo::STATUS_NOT_MAIN_PHOTO
        ]);

        $photoItem = $this->getPhoto($id);
        $photoItem->photoMain();
    }

}