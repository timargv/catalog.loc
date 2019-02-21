<?php

namespace App\Console\Commands\MirInstrument;

use App\Entity\Product;
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

    public function __construct(Product $product)
    {
        parent::__construct();
        $this->product = $product;
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
                $findProduct = Product::where('name_original', $product);

                if ($findProduct != null) {

                    $findProduct->update([
                        'available'     => $product['available'] == true ? $this->product::AVAILABLE_TRUE : $this->product::AVAILABLE_FALSE,
                        'name'          => $product->name,
                        'name_original' => $product->name,
                        'original_id'   => $product['id'],
                        'shipper'       => 'Мир Инструмента',
                        'original_url'  => $product->url,
                        'price'         => $product->price,
                        'category_id'   => $product->categoryId,
                        'picture'       => $product->picture,
                        'vendor'        => $product->vendor,
                        'vendor_code'   => $product->vendorCode,
                        'sh_desc'       => $product->description,
                        'desc'          => $product->description,
                        'barcode'       => $product->barcode,
                        'weight'        => $product->weight,
                    ]);
                    $updateProduct = $updateProduct + 1;

                } else {

                    Product::create([
                        'available'     => $product['available'] == true ? $this->product::AVAILABLE_TRUE : $this->product::AVAILABLE_FALSE,
                        'name'          => $product->name,
                        'name_original' => $product->name,
                        'original_id'   => $product['id'],
                        'shipper'       => 'Мир Инструмента',
                        'original_url'  => $product->url,
                        'price'         => $product->price,
                        'category_id'   => $product->categoryId,
                        'picture'       => $product->picture,
                        'vendor'        => $product->vendor,
                        'vendor_code'   => $product->vendorCode,
                        'sh_desc'       => $product->description,
                        'desc'          => $product->description,
                        'barcode'       => $product->barcode,
                        'weight'        => $product->weight,
                    ]);

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
