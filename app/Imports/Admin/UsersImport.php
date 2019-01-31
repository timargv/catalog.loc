<?php

namespace App\Imports\Admin;

use App\User;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class UsersImport implements ToModel, WithHeadingRow,  SkipsOnError
{
    use Importable, SkipsErrors;


    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name'     =>  $row['name'],
            'email'    =>  $row['email'],
            'password' => Hash::make( $row['password']),
        ]);

    }


//    public function batchSize(): int
//    {
//        return 5;
//    }
//
//
//    public function chunkSize(): int
//    {
//        return 5;
//    }
}


