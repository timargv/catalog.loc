<?php


namespace App\UseCases\Vendor;


use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class VendorMirInstrumentsService
{

    public function UploadXml () {

        $path = 'public\provider\mir-instruments\\';
        $pathFile = public_path() . '\storage\provider\mir-instruments\\';
        $pathFileTemp = public_path() . '\storage\provider\mir-instruments\temp\\';

        if(!file_exists($pathFile) && !file_exists($pathFileTemp)) {
            mkdir($pathFile, 666, true);
            mkdir($pathFileTemp, 666, true);
        }

        $url = "https://instrument.ru/yandexmarket/1b78da37-0b26-45a6-a885-095183509075.xml";
        $filename = 'mir-instruments.xml';

        $info = pathinfo($url);
        $contents = file_get_contents($url);
        $file = $pathFileTemp . $info['basename'];
        file_put_contents($file, $contents);
        $uploaded_file = new UploadedFile($file, $filename);
        Storage::putFileAs($path, new File($uploaded_file), $filename);

        $file = $pathFile . $filename;

        return $file;
    }

}