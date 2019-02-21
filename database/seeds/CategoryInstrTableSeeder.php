<?php

use App\Entity\Category;
use Illuminate\Database\Seeder;
use Prewk\XmlStringStreamer;
use Prewk\XmlStringStreamer\Stream\File;
use Prewk\XmlStringStreamer\Parser\StringWalker;

class CategoryInstrTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
            $progress = $readBytes / $totalSize;
            //report every 10%
//            if ($progress >= $last_progress + 0.1) {
//                echo "<script type='text/javascript'>console.log($progress);</script>";
//                $last_progress = $last_progress + 0.1;
//            }
        });

        // Construct the parser
        $parser = new StringWalker;

        // Construct the streamer
        $streamer = new XmlStringStreamer($parser, $stream);

        // Start parsing
        while ($node = $streamer->getNode()) {
            // $node will be a string like this: "<customer><firstName>Jane</firstName><lastName>Doe</lastName></customer>"
            $simpleXmlNode = simplexml_load_string($node);

            $categories = $simpleXmlNode->categories->category;

            foreach ($categories as $category) {

                $findCategory = Category::where('name', $category);

                if ($findCategory != null) {
                    $findCategory->update([
                        'name_original' => $category,
                        'name' => $category,
                        'parent_id' => $category['parentId']
                    ]);
                } else {

                    Category::create([
                        'id' => $category['id'],
                        'name' => $category,
                        'name_original' => $category,
                        'parent_id' => $category['parentId']
                    ]);
                }


            }

        }
    }
}
