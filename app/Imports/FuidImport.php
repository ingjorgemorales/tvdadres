<?php

namespace App\Imports;

use App\Models\FUID;
use Maatwebsite\Excel\Concerns\ToModel;

class FuidImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new FUID([
            //
        ]);
    }

    public function chunkSize(): int
    {
        return 1000; // o el tamaño que consideres adecuado
    }
}
