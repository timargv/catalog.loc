<?php

namespace App\Console\Commands\MirInstrument;

use App\Entity\Product;
use App\Entity\Shop\Attribute\Attribute;
use App\Http\Requests\Admin\Product\PhotosRequest;
use App\UseCases\Product\ProductService;
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
    protected $signature = 'mi:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    private $product;
    private $service;
    private $photosRequest;

    public function __construct(Product $product, ProductService $service, PhotosRequest $photosRequest)
    {
        parent::__construct();
        $this->product = $product;
        $this->service = $service;
        $this->photosRequest = $photosRequest;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $filename = "inst.xml";

        $file  = public_path('file\\' . $filename);

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

            $products = $simpleXmlNode->offers->offer;

            $this->getOutput()->progressStart(count($products));

            foreach ($products as $product) {

                $findProduct = Product::where('vendor_code_original', $product->vendorCode)->first();

                if ($findProduct != null) {

                    $findProduct->update([
                        'available'     => $product['available'] == true ? $this->product::AVAILABLE_TRUE : $this->product::AVAILABLE_FALSE,
                        'name'          => $product->name,
                        'name_original' => $product->name,
                        'original_id'   => $product['id'],
                        'original_url'  => $product->url,
                        'price'         => $product->price,
                        'category_id'   => $product->categoryId,
                        'vendor'        => $product->vendor,
                        'vendor_code'   => "20-".$product->vendorCode,
                        'sh_desc'       => $product->description,
                        'desc'          => $product->description,
                        'barcode'       => $product->barcode,
                        'weight'        => $product->weight,
                    ]);
                    $updateProduct = $updateProduct + 1;

                } else {


                    $productNew = Product::make([
                        'user_id' => 1,

                        'name' => $product->name,
                        'name_original' => $product->name,

                        // Статус товара активен или нет
                        'status' => $this->product::STATUS_ACTIVE,

                        // Категория
                        'category_id' => $this->service->getCategoryWhere($product->categoryId),

                        // В наличии или нет
                        'available' => $product['available'] == true ? $this->product::AVAILABLE_TRUE : $this->product::AVAILABLE_FALSE,

                        // ID в списке поставщика
                        'original_id' => $product['id'],

                        // Ссылка на сайт
                        'original_url' => $product->url,

                        // Цена
                        'price' => $product->price,

                        // Цена поставщика
                        'vendor_price' => $product->price,

                        // Валюта
                        'currency_id' => 1,

                        // Потсавшик
                        'vendor_id' => 2,

                        // Артикул
                        'vendor_code' => "20-".$product->vendorCode,

                        // Артикул Потсавшика
                        'vendor_code_original' => $product->vendorCode,

                        // Крат. Описание
                        'sh_desc' => $product->description,

                        // Полное описание
                        'desc' => $product->description,


                        // =============== Параметры упаковки
                        // Тип упаковки	Катронная коробка
//                        'type_packaging' => $request['type_packaging'],
//
//                        // Габариты в упаковке	810 x 730 x 580 мм
//                        'packing_dimensions' => $request['packing_dimensions'],
//
//                        // Длина в упаковке	мм
//                        'length' => $request['length'],
//
//                        // Ширина в упаковке мм
//                        'width' => $request['width'],
//
//                        // Высота в упаковке мм
//                        'height' => $request['height'],
//
                        // Штрих Код
                        'barcode' => $product->barcode,

                        // Ширина
                        'weight' => $product->weight,

                        'slug' => str_slug($product->name),


                    ]);

                    $productNew->saveOrFail();


                    foreach ($product->param as $value) {
                        $unit = $value[0]->attributes()->unit;
                        $get_unit = $unit == null ? '' : ', '.$unit;
//                        $name = str_replace("_","", $value[0]->attributes()->name) . $get_unit;
                        $name = str_replace("_","", $value[0]->attributes()->name);
                        $this->service->updateAttributeProductParser($productNew, $name, $value);

                    }

                    $files = $product->picture;


                    $this->service->addPhotos($productNew->id, $files);

                    $createProduct = $createProduct + 1;
                }
                $this->getOutput()->progressAdvance();
            }

            $this->getOutput()->progressFinish();
            $this->info('Обнавлено: '. $updateProduct);
            $this->info('Добавлено: '. $createProduct);

        }
    }
}
