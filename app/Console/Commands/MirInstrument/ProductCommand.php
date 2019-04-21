<?php

namespace App\Console\Commands\MirInstrument;

use App\Entity\Product;
use App\Entity\Shop\Attribute\Attribute;
use App\Http\Requests\Admin\Product\PhotosRequest;
use App\UseCases\Product\ProductService;
use App\UseCases\Vendor\VendorMirInstrumentsService;
use Illuminate\Console\Command;
use Prewk\XmlStringStreamer;
use Prewk\XmlStringStreamer\Stream\File;
use Prewk\XmlStringStreamer\Parser\StringWalker;

class ProductCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mi:product {update-price?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Product argument[update-price, update-brand]';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    private $product;
    private $service;
    private $photosRequest;
    private $file;

    public function __construct(Product $product, ProductService $service, PhotosRequest $photosRequest, VendorMirInstrumentsService $fileXml)
    {
        parent::__construct();
        $this->product = $product;
        $this->service = $service;
        $this->photosRequest = $photosRequest;
        $this->file = $fileXml;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle()
    {

        $update_price = $this->argument('update-price');
//        dd($update_price);

        $file = $this->file->UploadXml();

        // Save the total file size
        $totalSize = filesize($file);

        $progress = 0;
        $last_progress = 0;

        // Construct the file stream
        $stream = new File($file, 16384, function($chunk, $readBytes) use ($progress, &$last_progress, $totalSize) {
            // This closure will be called every time the streamer requests a new chunk of data from the XML file
//            $progress = $readBytes / $totalSize;

            // report every 10%
//            if ($progress >= $last_progress + 0.1) {
//                $this->info($progress);
//                $last_progress = $last_progress + 0.1;
//            }

        });

        // Construct the parser
        $parser = new StringWalker;

        // Construct the streamer
        $streamer = new XmlStringStreamer($parser, $stream);

        // Update
        $updateProduct = 0;

        // Create
        $createProduct = 0;

        // Please stop add Information
        $this->info('Подождите идет сбор инфрмации: ');

        // Start parsing
        while ($node = $streamer->getNode()) {

            $simpleXmlNode = simplexml_load_string($node,null, LIBXML_NOCDATA);

//            $products = $simpleXmlNode->offers->offer;
            $products = $simpleXmlNode->xpath('//offers/offer');

            $this->getOutput()->progressStart(count($products));

            if($update_price == 'update-price'){
                $this->UpdatePrice($products, $updateProduct);
            } elseif ($update_price == 'update-brands') {
                $this->UpdateBrand($products, $updateProduct);
            } else {
                foreach ($products as $product) {

                    // Найти Продукт
                    $findProduct = Product::where('vendor_code_original', $product->vendorCode->__toString())->first();

                    if ($findProduct != null) {

                        $this->product->priceHistory($findProduct, '', floatval($product->price->__toString()));
                        // Обновить Продукт
                        $findProduct->update([
                            'name' => $product->name->__toString(),
                            'name_original' => $product->name->__toString(),

                            // Статус товара активен или нет
                            'status' => $this->product::STATUS_ACTIVE,

                            // Категория
                            'category_id' => intval($this->service->getCategoryWhere($product->categoryId->__toString())),

                            // В наличии или нет
                            'available' => $product['available'] == true ? $this->product::AVAILABLE_TRUE : $this->product::AVAILABLE_FALSE,

                            // ID в списке поставщика
                            'original_id' => intval($product->id->__toString()),

                            // Ссылка на сайт
                            'original_url' => $product->url->__toString(),

                            // Цена
                            // 'price' => $product->price->__toString(),

                            // Цена поставщика
                            'vendor_price' => floatval($product->price->__toString()),

                            // Валюта
                            'currency_id' => 1,

                            // Потсавшик
                            'vendor_id' => 2,

                            // Артикул
                            'vendor_code' => "20-" . $product->vendorCode->__toString(),

                            // Артикул Потсавшика
                            'vendor_code_original' => $product->vendorCode->__toString(),

                            // Крат. Описание
                            'sh_desc' => $product->description->__toString(),

                            // Полное описание
                            'desc' => $product->description->__toString(),

                            'barcode' => $product->barcode->__toString(),

                            // Ширина
                            'weight' => $product->weight->__toString(),

                            'slug' => str_slug($product->name->__toString()),


                        ]);

                        // Счетчик Обновления
                        $updateProduct = $updateProduct + 1;

                    } else {
                        // Создать Продукт
                        $productNew = Product::make([
                            'user_id' => 1,

                            'name' => $product->name->__toString(),
                            'name_original' => $product->name->__toString(),

                            // Статус товара активен или нет
                            'status' => $this->product::STATUS_ACTIVE,

                            // Категория
                            'category_id' => intval($this->service->getCategoryWhere($product->categoryId->__toString())),

                            // В наличии или нет
                            'available' => $product['available'] == true ? $this->product::AVAILABLE_TRUE : $this->product::AVAILABLE_FALSE,

                            // ID в списке поставщика
                            'original_id' => intval($product->id->__toString()),

                            // Ссылка на сайт
                            'original_url' => $product->url->__toString(),

                            // Цена
                            'price' => floatval($product->price->__toString()),

                            // Цена поставщика
                            'vendor_price' => floatval($product->price->__toString()),

                            // Валюта
                            'currency_id' => 1,

                            // Потсавшик
                            'vendor_id' => 2,

                            // Артикул
                            'vendor_code' => "20-".$product->vendorCode->__toString(),

                            // Артикул Потсавшика
                            'vendor_code_original' => $product->vendorCode->__toString(),

                            // Крат. Описание
                            'sh_desc' => $product->description->__toString(),

                            // Полное описание
                            'desc' => $product->description->__toString(),

                            'barcode' => $product->barcode->__toString(),

                            // Ширина
                            'weight' => $product->weight->__toString(),

                            'slug' => str_slug($product->name->__toString()),


                        ]);

                        // Сохранить
                        $productNew->saveOrFail();



                        // Пройтись по Атрибутам товара и сохранить их
                        foreach ($product->param as $value) {
//                        $unit = $value[0]->attributes()->unit;
//                        $get_unit = $unit == null ? '' : ', '.$unit;
//                        $name = str_replace("_","", $value[0]->attributes()->name) . $get_unit;

                            $name = str_replace("_","", $value[0]->attributes()->name);
                            $this->service->updateAttributeProductParser($productNew, $name, $value->__toString());
                        }



                        // Массив для картинок
                        $files = [];

                        // Сохранить картинки в массив
                        foreach ($product->picture as $value) {
                            $files[] = $value->__toString();
                        }


                        // Добавить фотографии для товара
                        $this->service->addPhotosImport($productNew->id, $files);

                        // Счетчик Добавления
                        $createProduct = $createProduct + 1;


                    }
                    $this->getOutput()->progressAdvance();
                }
            }

            $this->getOutput()->progressFinish();
            $this->info('Обнавлено: '. $updateProduct);
            $this->info('Добавлено: '. $createProduct);

        }
    }

    public function UpdatePrice($products, $updateProduct) {
        foreach ($products as $product) {
            // Найти Продукт
            $findProduct = Product::where('vendor_code_original', $product->vendorCode->__toString())->first();

            if ($findProduct != null) {

                $this->product->priceHistory($findProduct, '', floatval($product->price->__toString()));

                // Обновить Продукт
                $findProduct->update([
                    // Цена поставщика
                    'vendor_price' => floatval($product->price->__toString()),
                ]);

                // Счетчик Обновления
                $updateProduct = $updateProduct + 1;

            }
            $this->getOutput()->progressAdvance();
        }

        return $updateProduct;
    }

    public function UpdateBrand($products, $updateProduct) {
        foreach ($products as $product) {
            // Найти Продукт
            $findProduct = Product::where('vendor_code_original', $product->vendorCode->__toString())->first();

            if ($findProduct != null) {

                $brand_id = null;

                foreach ($product->param as $value) {
                    $name = str_replace("_","", $value[0]->attributes()->name);
                    if ($name == 'Бренд') {
                        $brand_id = $this->service->setBrand($value);
                    }
                }

                // Обновить Продукт
                $findProduct->update([
                    // Цена поставщика
                    'brand_id' => $brand_id,
                ]);

                // Счетчик Обновления
                $updateProduct = $updateProduct + 1;

            }
            $this->getOutput()->progressAdvance();
        }

        return $updateProduct;
    }
}
