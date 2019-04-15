<?php
/**
 * Created by PhpStorm.
 * User: Jo
 * Date: 07.02.2019
 * Time: 13:12
 */

namespace App\UseCases\Category;

use App\Entity\Category;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Http\Requests\Admin\Category\CreateRequest;
use App\Jobs\MirInstrument\CategoryFix;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;


class CategoryService
{

    private $category;

    public function __construct (Category $category)
    {
        $this->category = $category;
    }

    public function create(CreateRequest $request) {

        return DB::transaction(function () use ($request) {

            /** @var Category $category */
            $category = Category::make([
                'name' => $request['name'],
                'name_original' => $request['name_original'],

                'name_h1' => $request['name_h1'],
                'meta_description' => $request['meta_description'],
                'meta_title' => $request['meta_title'],
                'meta_keywords' => $request['meta_keywords'],

                'description' => $request['description'],
                'code' => $request['code'],
                'image' => $request['image'],
                'icon' => $request['icon'],

                'status' => Category::STATUS_ACTIVE,
                'slug' => $request['slug'],
                'parent_id' => $request['parent'],
            ]);

            $category->saveOrFail();

            $this->addPhoto($category, $request->only(['image']));
            $this->addIcon($category, $request->only(['icon']));

            return $category;
        });

    }



    public function edit($category, UpdateRequest $request): void
    {

        $this->addPhoto($category, $request->only(['image']));
        $this->addIcon($category, $request->only(['icon']));

        $category->update($request->only([
            'name',
            'name_original',

            'name_h1',
            'meta_description',
            'meta_title',
            'meta_keywords',

            'description',
            'code',

            'status',
            'slug',
            'parent_id',
        ]));
    }


    // Фикс после импорта Категории
    // МИР ИНСТРУМЕНТА
    //=====================================
    public function fix () {
        $categoryJob = (new CategoryFix())->delay(Carbon::now()->addSeconds(3));
        dispatch($categoryJob);

        return redirect()->back()->with('info', 'Категории скоро будут Пофиксены');
    }

    public static function getCategoryRoot() {
        return Cache::remember('categoriesRoot', 60, function () {
            return Category::get()->toTree();
        });
    }

    public function pathPhoto()
    {
        $paths = [
            'original' => public_path() . '\storage\category\original\\',
            'thumbnail' => public_path() . '\storage\category\thumbnail\\',
            'thumbnail_category' => public_path() . '\storage\category\thumbnail_category\\',
            'item' => public_path() . '\storage\category\item\\',
            'small' => public_path() . '\storage\category\small\\',
            'medium' => public_path() . '\storage\category\medium\\',
            'large' => public_path() . '\storage\category\large\\',
        ];
        return $paths;
    }

    public function pathIcon()
    {
        $paths = [
            'original' => public_path() . '\storage\category\icon\original\\',
            'thumbnail' => public_path() . '\storage\category\icon\thumbnail\\',
            'item' => public_path() . '\storage\category\icon\item\\',
            'small' => public_path() . '\storage\category\icon\small\\',
            'medium' => public_path() . '\storage\category\icon\medium\\',
            'large' => public_path() . '\storage\category\icon\large\\',
        ];
        return $paths;
    }

    public function addPhoto ($category, $request) : void {

        if (empty($request['image'])) {
            return;
        }

        if (!empty($category->image)) {
            $this->removePhoto($category);
        }

        DB::transaction(function () use ($request, $category) {
            $path = $this->pathPhoto()['original'];
            $thumbCategoryPath = $this->pathPhoto()['thumbnail_category'];
            $thumbPath = $this->pathPhoto()['thumbnail'];
            $itemPath = $this->pathPhoto()['item'];
            $smallPath = $this->pathPhoto()['small'];
            $middlePath = $this->pathPhoto()['medium'];
            $largePath = $this->pathPhoto()['large'];

//            $img = new ImageManager;
            $img = [
                Image::make($request['image']),
                Image::make($request['image']),
                Image::make($request['image']),
                Image::make($request['image']),
                Image::make($request['image']),
                Image::make($request['image']),
                Image::make($request['image']),
            ];
//            $img->make($request['image']);

            if (!file_exists($path) && !file_exists($itemPath) && !file_exists($thumbPath) && !file_exists($smallPath) && !file_exists($middlePath) && !file_exists($largePath)) {
                mkdir($path, 666, true);
                mkdir($thumbPath, 666, true);
                mkdir($itemPath, 666, true);
                mkdir($smallPath, 666, true);
                mkdir($thumbCategoryPath, 666, true);
                mkdir($middlePath, 666, true);
                mkdir($largePath, 666, true);
            }

            $fileName = $category->id.'-'.uniqid().'-'. (new \DateTime)->getTimeStamp() . '.png';



            $img[6]->save($path . $fileName);
            $img[0]->resize(1024, null, function ($constraint) {$constraint->aspectRatio();})->resizeCanvas(1280, 1024, 'center', false, 'ffffff')->save($largePath .$fileName, 100);
            $img[1]->resize(412, null, function ($constraint) {$constraint->aspectRatio();})->resizeCanvas(512, 512, 'center', false, 'ffffff')->save($middlePath . $fileName, 100);
            $img[2]->resize(206, null, function ($constraint) {$constraint->aspectRatio();})->resizeCanvas(256, 256, 'center', false, 'ffffff')->save($smallPath . $fileName, 100);
            $img[3]->resize(120, null, function ($constraint) {$constraint->aspectRatio();})->resizeCanvas(170, 170, 'center', false, 'f4f4f4')->save($thumbCategoryPath . $fileName, 100);
            $img[4]->resize(98, null, function ($constraint) {$constraint->aspectRatio();})->resizeCanvas(128, 128, 'center', false, 'ffffff')->save($thumbPath . $fileName, 100);
            $img[5]->resize(44, null, function ($constraint) {$constraint->aspectRatio();})->resizeCanvas(64, 64, 'center', false, 'ffffff')->save($itemPath . $fileName, 100);

            $category->update([
                'image' => $fileName
            ]);

        });

    }

    public function removePhoto ($category): void {
        Storage::disk('public')->delete([
            '\category\original\\'.$category->image,
            '\category\thumbnail\\'.$category->image,
            '\category\thumbnail_category\\'.$category->image,
            '\category\small\\'.$category->image,
            '\category\medium\\'.$category->image,
            '\category\large\\'.$category->image,
            '\category\item\\'.$category->image,
        ]);

        $category->update([
            'image' => ''
        ]);
    }

    public function addIcon ($category, $request) : void {

        if (empty($request['icon'])) {
            return;
        }

        if (!empty($category->icon)) {
            $this->removeIcon($category);
        }

        DB::transaction(function () use ($request, $category) {
            $path = $this->pathIcon()['original'];
            $thumbPath = $this->pathIcon()['thumbnail'];
            $itemPath = $this->pathIcon()['item'];
            $smallPath = $this->pathIcon()['small'];
            $middlePath = $this->pathIcon()['medium'];
            $largePath = $this->pathIcon()['large'];

            $img = [
                Image::make($request['icon']),
                Image::make($request['icon']),
                Image::make($request['icon']),
                Image::make($request['icon']),
                Image::make($request['icon']),
                Image::make($request['icon']),
            ];

            if (!file_exists($path) && !file_exists($itemPath) && !file_exists($thumbPath) && !file_exists($smallPath) && !file_exists($middlePath) && !file_exists($largePath)) {
                mkdir($path, 666, true);
                mkdir($thumbPath, 666, true);
                mkdir($itemPath, 666, true);
                mkdir($smallPath, 666, true);
                mkdir($middlePath, 666, true);
                mkdir($largePath, 666, true);
            }

            $fileName = $category->id.'-'.uniqid().'-'. (new \DateTime)->getTimeStamp() . '.png';

            $img[5]->save($path . $fileName);
            $img[0]->resize(1024, null, function ($constraint) {$constraint->aspectRatio();})->resizeCanvas(1280, 1024, 'center', false, 'rgba(255, 255, 255, 0)')->save($largePath .$fileName, 100);
            $img[1]->resize(412, null, function ($constraint) {$constraint->aspectRatio();})->resizeCanvas(512, 512, 'center', false, 'rgba(255, 255, 255, 0)')->save($middlePath . $fileName, 100);
            $img[2]->resize(206, null, function ($constraint) {$constraint->aspectRatio();})->resizeCanvas(256, 256, 'center', false, 'rgba(255, 255, 255, 0)')->save($smallPath . $fileName, 100);
            $img[3]->resize(98, null, function ($constraint) {$constraint->aspectRatio();})->resizeCanvas(128, 128, 'center', false, 'rgba(255, 255, 255, 0)')->save($thumbPath . $fileName, 100);
            $img[4]->resize(44, null, function ($constraint) {$constraint->aspectRatio();})->resizeCanvas(64, 64, 'center', false, 'rgba(255, 255, 255, 0)')->save($itemPath . $fileName, 100);

            $category->update([
                'icon' => $fileName
            ]);

        });

    }

    public function removeIcon ($category): void {
        Storage::disk('public')->delete([
            '\category\icon\original\\'.$category->icon,
            '\category\icon\thumbnail\\'.$category->icon,
            '\category\icon\small\\'.$category->icon,
            '\category\icon\medium\\'.$category->icon,
            '\category\icon\large\\'.$category->icon,
            '\category\icon\item\\'.$category->icon,
        ]);

        $category->update([
            'image' => ''
        ]);
    }

}
