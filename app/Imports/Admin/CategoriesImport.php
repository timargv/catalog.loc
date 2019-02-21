<?php

namespace App\Imports\Admin;

use App\Entity\Category;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\BeforeImport;

class CategoriesImport implements ToModel, WithValidation, WithEvents
{
    use Importable, RegistersEventListeners;


    public function model(array $row)
    {
        return new Category([
            'name'     =>   $row['сategory'],
        ]);
    }



//    public function sheets(): array
//    {
//        return [
//            // Select by sheet index
//            0 => new UsersImport(),
//        ];
//    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            '*.name' => 'required|string',
        ];
    }
}
