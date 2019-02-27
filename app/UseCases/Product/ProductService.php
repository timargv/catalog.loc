<?php

namespace App\UseCases\Product;


use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Shop\Attribute\Attribute;
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
            'item' => public_path() . '\storage\products\item\\',
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
            $itemPath = $this->pathPhoto()['item'];
            $smallPath = $this->pathPhoto()['small'];
            $middlePath = $this->pathPhoto()['medium'];
            $largePath = $this->pathPhoto()['large'];

            $productPhotos = $product->photos()->count();

             foreach ($request['files'] as $key => $file) {

                $img = Image::make($file);
                if (!file_exists($path) && !file_exists($itemPath) && !file_exists($thumbPath) && !file_exists($smallPath) && !file_exists($middlePath) && !file_exists($largePath)) {
                    mkdir($path, 666, true);
                    mkdir($thumbPath, 666, true);
                    mkdir($itemPath, 666, true);
                    mkdir($smallPath, 666, true);
                    mkdir($middlePath, 666, true);
                    mkdir($largePath, 666, true);
                }

                $fileName = $product->id.'-'.uniqid().'-'. (new \DateTime)->getTimeStamp() . '.png';

                $img->save($path . $fileName);
                $img->resize(1000, 1000)->save($largePath .$fileName, 100);
                $img->resize(450, 450)->save($middlePath . $fileName, 100);
                $img->resize(150, 150)->save($smallPath . $fileName, 100);
                $img->resize(320, 320)->save($thumbPath . $fileName, 100);
                $img->resize(80, 80)->save($itemPath . $fileName, 100);

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

    public function getProductVendorCode($vendor_code): Product {
        return Product::where('vendor_code_original', $vendor_code)->first();
    }

    private function getAttributeName ($name)
    {
        return Attribute::where('name', $name)->first();
    }

    private function getAttribute ($id): Attribute
    {
        return Attribute::findOrFail($id);
    }

    public function getCategoryWhere ($shipperId)
    {
        $category = Category::where('shipper_id', $shipperId)->firstOrFail();
        return $category->id;
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

    public function remove($id): void
    {
        $product = $this->getProduct($id);
        $this->removePhotos($id);
        $product->values()->delete();
        $product->delete();
    }

    public function updateAttributeProductParser($product, $name, $value)
    {
        $attribute = $this->getAttributeName($name);
        $product = $this->getProduct($product->id);
        $category = $product->category;

        if (!empty($attribute) && $name != 'Бренд' && $name != 'БрендАртикула') {

            if ($name != 'Тип упаковки'
            && $name != 'Габариты в упаковке'
            && $name != 'Длина в упаковке'
            && $name != 'Ширина в упаковке'
            && $name != 'Высота в упаковке'
            && $name != 'Вес') {
                $product->values()->create([
                    'attribute_id' => $attribute->id,
                    'value' => $value,
                ]);
            }

            $this->getAttribute($attribute->id)->setCategories($category);
            if ($name == 'Тип упаковки' ) {
                $product->update([
                    'type_packaging' => $value,
                ]);
            }
            if ($name == 'Габариты в упаковке') {
                $product->update([
                    // Габариты в упаковке	810 x 730 x 580 мм
                    'packing_dimensions' => $value
                ]);
            }
            if ($name == 'Длина в упаковке' ) {
                $product->update([
                    // Длина в упаковке	мм
                    'length' => $value
                ]);
            }
            if ($name == 'Ширина в упаковке') {
                $product->update([
                    // Ширина в упаковке мм
                    'width' => $value,
                ]);
            }
            if ($name == 'Высота в упаковке') {
                $product->update([
                    // Высота в упаковке мм
                    'height' => $value,
                ]);
            }

        }

    }

}