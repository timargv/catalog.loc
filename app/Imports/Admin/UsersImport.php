<?php

namespace App\Imports\Admin;

use App\User;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Validators\ValidationException;


class UsersImport implements ToModel, WithValidation, WithHeadingRow, WithMultipleSheets, WithEvents
{
    use Importable, RegistersEventListeners;

    public static function beforeImport(BeforeImport $event)
    {
        $worksheet = $event->reader->getActiveSheet();
        $highestRow = $worksheet->getHighestRow(); // e.g. 10

        if ($highestRow < 2) {
            $error = \Illuminate\Validation\ValidationException::withMessages([]);
            $failure = new Failure(1, 'rows', [0 => 'Now enough rows!']);
            $failures = [0 => $failure];
            throw new ValidationException($error, $failures);
        }
    }

    public function model(array $row)
    {
        return new User([
            'name'     =>   $row['name'],
            'email'    =>   $row['email'],
            'password' =>   Hash::make( $row['password']),
        ]);
    }

//    public function batchSize(): int
//    {
//        return 5;
//    }
//
//    public function chunkSize(): int
//    {
//        return 5;
//    }

    public function sheets(): array
    {
        return [
            // Select by sheet index
            0 => new UsersImport(),
        ];
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            '*.name' => 'required|string',
        ];
    }




}


