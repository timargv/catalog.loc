<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Shop\Attribute\AttributeGroup;
use App\Entity\Vendor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\Product\PhotosRequest;
use App\UseCases\Product\ProductService;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;


class ProductsController extends Controller
{
    private $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
        $this->middleware('can:admin-panel');
    }

    public function index(Request $request)
    {
        //
        $categories = Category::defaultOrder()->withDepth()->get();

        if (empty($request->all())) {
            $products = Product::orderBy('id', 'DESC')->with('category', 'currency', 'vendor', 'photos');
        } else {
            $products = Product::with('category', 'currency', 'vendor', 'photos');
        }

        $query = $products;

        if (!empty($value = $request->get('name'))) {
            $query->where('name_original', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('vendor_code'))) {
            $query->where('vendor_code', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('price'))) {
            $query->where('price', '>=', $value)->orderBy('price', 'ASC');
        }

        if (!empty($value = $request->get('vendor_price'))) {
            $query->where('vendor_price', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('category'))) {
            $query->where('category_id', $value);
        }

        $products = $query->paginate(15);

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::defaultOrder()->withDepth()->get();
        $vendors = Vendor::all();
        $brands = Brand::all();
        $statuses = Product::statusesList();
        $statusAvailable = Product::statusesAvailable();

        return view('admin.products.create', compact('statuses', 'statusAvailable', 'categories', 'vendors', 'brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'categories' => 'required',
            'quantity' => 'required|numeric',
            'vendor_code' => 'required|string|max:255|unique:products',
            'slug' => 'required|string|max:255|unique:products',
//            'parent' => 'nullable|integer|exists:categories,id',
        ]);

//        dd($request);
        $product = Product::make([
            'user_id' => 1,

            'name' => $request['name'],
            'name_original' => $request['name_original'],

            // Статус товара активен или нет
            'status' => $request['status'],

            // Категория
            'category_id' => $request['categories'],

            // В наличии или нет
            'available' => $request['available'],

            // ID в списке поставщика
            'original_id' => $request['original_id'],

            // Ссылка на сайт
            'original_url' => $request['original_url'],

            // Количество в наличии
            'quantity' => $request['quantity'],

            // Цена
            'price' => str_replace([' ', ' ₽'],'', $request['price']),

            // Цена поставщика
            'vendor_price' => str_replace([' ', ' ₽'],'', $request['vendor_price']),

            // Валюта
            'currency_id' => $request['currency_id'],

            // Главная Картинка
            'picture' => $request['picture'],

            // Потсавшик
            'vendor_id' => $request['vendor'],

            // Артикул
            'vendor_code' => $request['vendor_code'],

            // Артикул Потсавшика
            'vendor_code_original' => $request['vendor_code_original'],

            // Крат. Описание
            'sh_desc' => $request['sh_desc'],

            // Полное описание
            'desc' => $request['desc'],

            // Бренд
            'brand_id' => $request['brand'],

            // =============== Параметры упаковки
            // Тип упаковки	Катронная коробка
            'type_packaging' => $request['type_packaging'],

            // Габариты в упаковке	810 x 730 x 580 мм
            'packing_dimensions' => $request['packing_dimensions'],

            // Длина в упаковке	мм
            'length' => $request['length'],

            // Ширина в упаковке мм
            'width' => $request['width'],

            // Высота в упаковке мм
            'height' => $request['height'],

            // Штрих Код
            'barcode' => $request['barcode'],

            // Ширина
            'weight' => $request['weight'],

            'slug' => $request['slug'],
//            'parent_id' => $request['parent'],


        ]);

        $product->saveOrFail();

        foreach ($product->category->allAttributes() as $attribute) {
            $value = $request['attributes'][$attribute->id] ?? null;
            if (!empty($value)) {
                $product->values()->create([
                    'attribute_id' => $attribute->id,
                    'value' => $value,
                ]);
            }
        }

        return redirect()->route('admin.products.edit', $product)->with('success', 'Товар добавлен! Вы можете дополнить его!');
    }

    public function show(Product $product)
    {
        //
        $categories = Category::defaultOrder()->withDepth()->get();
        $vendors = Vendor::all();
        $brands = Brand::all();
        $statuses = Product::statusesList();
        $statusAvailable = Product::statusesAvailable();

        return view('admin.products.show', compact('product','statuses', 'statusAvailable', 'categories', 'vendors', 'brands'));
    }

    public function edit(Product $product)
    {


//        $path = public_path() . '\storage\products\original\\';
//
//        $img = Image::make('https://instrument.ru/wa-data/public/shop/products/29/38/43829/images/78652/78652.970.jpg');
//        $fileName = $product->id.'-'.uniqid().'-'. (new \DateTime)->getTimeStamp() . '.png';
//        $img->save($path . $fileName);
//
//        dd($img);

        $categories = Category::defaultOrder()->withDepth()->get();
        $vendors = Vendor::all();
        $brands = Brand::all();
        $statuses = Product::statusesList();
        $statusAvailable = Product::statusesAvailable();

        dd($product->attributes);


        return view('admin.products.edit', compact('product','statuses', 'statusAvailable', 'categories', 'vendors', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required',
            'categories' => 'required',
            'quantity' => 'required|numeric',
            'vendor_code' => 'required|'.Rule::unique('products', 'vendor_code')->ignore($product->id),
            'slug' => 'required|string|max:255|'. Rule::unique('products', 'slug')->ignore($product->id),
        ]);

        $product->values()->delete();
        foreach ($product->category->allAttributes() as $attribute) {
            $value = $request['attributes'][$attribute['id']] ?? null;
            if (!empty($value)) {
                $product->values()->create([
                    'attribute_id' => $attribute['id'],
                    'value' => $value,
                ]);
            }
        }

        $price = str_replace([' ', ' ₽'],'', $request['price']);
        $vendor_price = str_replace([' ', ' ₽'],'', $request['vendor_price']);

        $this->service->setPriceHistory($product, $price, $vendor_price);

        $product->update([
            'user_id' => Auth::id(),

            'name' => $request['name'],
            'name_original' => $request['name_original'],

            // Статус товара активен или нет
            'status' => $request['status'],

            // Категория
            'category_id' => $request['categories'],

            // В наличии или нет
            'available' => $request['available'],

            // ID в списке поставщика
            'original_id' => $request['original_id'],

            // Ссылка на сайт
            'original_url' => $request['original_url'],

            // Количество в наличии
            'quantity' => $request['quantity'],

            // Цена
            'price' => str_replace([' ', ' ₽'],'', $request['price']),

            // Цена поставщика
            'vendor_price' => str_replace([' ', ' ₽'],'', $request['vendor_price']),

            // Валюта
            'currency_id' => $request['currency_id'],

            // Главная Картинка
            'picture' => $request['picture'],

            // Потсавшик
            'vendor_id' => $request['vendor'],

            // Артикул
            'vendor_code' => $request['vendor_code'],

            // Артикул Потсавшика
            'vendor_code_original' => $request['vendor_code_original'],

            // Крат. Описание
            'sh_desc' => $request['sh_desc'],

            // Полное описание
            'desc' => $request['desc'],

            // Бренд
            'brand_id' => $request['brand'],

            // =============== Параметры упаковки
            // Тип упаковки	Катронная коробка
            'type_packaging' => $request['type_packaging'],

            // Габариты в упаковке	810 x 730 x 580 мм
            'packing_dimensions' => $request['packing_dimensions'],

            // Длина в упаковке	мм
            'length' => $request['length'],

            // Ширина в упаковке мм
            'width' => $request['width'],

            // Высота в упаковке мм
            'height' => $request['height'],

            // Штрих Код
            'barcode' => $request['barcode'],

            // Ширина
            'weight' => $request['weight'],

            'slug' => $request['slug'],
        ]);

//        $product->setCategories($request['categories']);
        return redirect()->back();
    }

    public function destroy(Product $product)
    {
        try {
            $this->service->remove($product->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('admin.products.index');
    }

    public function photosForm(Product $product)
    {
        return redirect()->route('admin.products.edit.photos', $product);
    }


    // =================== Добавление Фотографии
    public function photos(PhotosRequest $request, Product $product)
    {
        try {
            $this->service->addPhotos($product->id, $request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('admin.products.edit', $product);
    }

    // =================== Удалить Фотографию
    public function destroyPhoto($product, $id)
    {

        try {
            $this->service->removePhoto($id);
        } catch (\DomainException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('info', 'Фото удалено!');
    }

    // =================== Удалить ВСЕ Фотография
    public function destroyPhotos(Product $product)
    {
        try {
            $this->service->removePhotos($product->id);
        } catch (\DomainException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->back()->with('info', 'Все картинки удалены!');
    }

    public function updatePhotoMain($product, $id)
    {
        try {
            $this->service->isMainPhoto($product, $id);
        } catch (\DomainException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->back()->with('info', 'Главная картинка изменена!');
    }

}
