<?php

namespace App\Console\Commands\MirInstrument;

use App\UseCases\Vendor\VendorMirInstrumentsService;
use Illuminate\Console\Command;
use App\Entity\Category;
use Illuminate\Http\File as FileDow;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Prewk\XmlStringStreamer;
use Prewk\XmlStringStreamer\Stream\File;
use Prewk\XmlStringStreamer\Parser\StringWalker;

class CategoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mi:category';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Обновление или Создание категорий Мир Инструмента';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    private $categoryParentId;
    private $file;

    public function __construct(Category $category, VendorMirInstrumentsService $fileXml)
    {
        parent::__construct();
        $this->categoryParentId = $category;
        $this->file = $fileXml;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

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
//

        });

        // Construct the parser
        $parser = new StringWalker;

        // Construct the streamer
        $streamer = new XmlStringStreamer($parser, $stream);

        // Update
        $updateCategory = 0;

        // Create
        $createCategory = 0;

        // Please stop add Information
        $this->info('Подождите идет сбор инфрмации: ');

        // Start parsing
        while ($node = $streamer->getNode()) {
            // $node will be a string like this: "<customer><firstName>Jane</firstName><lastName>Doe</lastName></customer>"
            $simpleXmlNode = simplexml_load_string($node);

            $categories = $simpleXmlNode->categories->category;


            $this->getOutput()->progressStart(count($categories));
            foreach ($categories as $category) {

//                dd($category->attributes()->id->__toString());

                $findCategory = $this->categoryParentId->where([
                    ['shipper_id', $category->attributes()->id->__toString()]
                ])->first();

                //  Проверка сушествует ли данная категория
                // Если да то обновить
                if ($findCategory != false) {
                    $this->categoryParentId->where('shipper_id', $category->attributes()->id)->update([
                        'shipper_id'        => $category->attributes()->id->__toString(),
//                        'name'              => $category,
                        'name_original'     => $category->__toString(),
                    ]);


                    $updateCategory = $updateCategory + 1;

                } else {

                    $parentId = $category['parentId'] != null ? $category['parentId'] : 0;

                    $newCategory = Category::create([
                        'shipper_id' => $category->attributes()->id != null ? $category->attributes()->id : null,
                        'name' => $category,
                        'name_original' => $category,
                    ]);
//                    if ($parentId != 0) {
//                        $this->categoryParentId->where('id', $newCategory->id)->update([
//                            'parent_id' => $parentId
//                        ]);
//                    }
                    if ($parentId != 0) {
                        $categoryID = Category::where('shipper_id', $parentId)->first();
                        $newCategory->update([
                            'parent_id' => $categoryID->id
                        ]);
                    }

                    $createCategory = $createCategory + 1;
                }
                $this->getOutput()->progressAdvance();
            }

            $this->getOutput()->progressFinish();

            $this->info('Обнавлено: '. $updateCategory);
            $this->info('Добавлено: '. $createCategory);


        }

//        $this->categoryParentId::fixTree();

    }
}
