<?php
/**
 * Created by PhpStorm.
 * User: Jo
 * Date: 07.02.2019
 * Time: 13:12
 */

namespace App\UseCases\Category;

use App\Entity\Category;
use App\Http\Requests\Admin\Category\IconRequest;
use App\Http\Requests\Admin\Category\PhotosRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Http\Requests\Admin\Category\CreateRequest;
use App\Jobs\MirInstrument\CategoryFix;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
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

            $this->addPhoto($category);

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


//
//        'image'
//            'icon'
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
            $thumbPath = $this->pathPhoto()['thumbnail'];
            $itemPath = $this->pathPhoto()['item'];
            $smallPath = $this->pathPhoto()['small'];
            $middlePath = $this->pathPhoto()['medium'];
            $largePath = $this->pathPhoto()['large'];

            $img = Image::make($request['image']);

            if (!file_exists($path) && !file_exists($itemPath) && !file_exists($thumbPath) && !file_exists($smallPath) && !file_exists($middlePath) && !file_exists($largePath)) {
                mkdir($path, 666, true);
                mkdir($thumbPath, 666, true);
                mkdir($itemPath, 666, true);
                mkdir($smallPath, 666, true);
                mkdir($middlePath, 666, true);
                mkdir($largePath, 666, true);
            }

            $fileName = $category->id.'-'.uniqid().'-'. (new \DateTime)->getTimeStamp() . '.png';

            $img->save($path . $fileName);
            $img->fit(1000, 1000)->save($largePath .$fileName, 100);
            $img->fit(450, 450)->save($middlePath . $fileName, 100);
            $img->fit(150, 100)->save($smallPath . $fileName, 100);
            $img->fit(320, 180)->save($thumbPath . $fileName, 100);
            $img->fit(80, 60)->save($itemPath . $fileName, 100);

            $category->update([
                'image' => $fileName
            ]);

        });

    }

    public function removePhoto ($category): void {
        Storage::disk('public')->delete([
            '\category\original\\'.$category->image,
            '\category\thumbnail\\'.$category->image,
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

            $img = Image::make($request['icon']);

            if (!file_exists($path) && !file_exists($itemPath) && !file_exists($thumbPath) && !file_exists($smallPath) && !file_exists($middlePath) && !file_exists($largePath)) {
                mkdir($path, 666, true);
                mkdir($thumbPath, 666, true);
                mkdir($itemPath, 666, true);
                mkdir($smallPath, 666, true);
                mkdir($middlePath, 666, true);
                mkdir($largePath, 666, true);
            }

            $fileName = $category->id.'-'.uniqid().'-'. (new \DateTime)->getTimeStamp() . '.png';

            $img->save($path . $fileName);
            $img->fit(1000, 1000)->save($largePath .$fileName, 100);
            $img->fit(450, 450)->save($middlePath . $fileName, 100);
            $img->fit(150, 150)->save($smallPath . $fileName, 100);
            $img->fit(320, 320)->save($thumbPath . $fileName, 100);
            $img->fit(80, 80)->save($itemPath . $fileName, 100);

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
