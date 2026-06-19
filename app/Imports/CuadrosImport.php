<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithSkipDuplicates;

class CuadrosImport implements ToModel, WithSkipDuplicates
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        /*return new Cuadro([
            'id_cabeceraccd' => $row[0],
            'acto_administrativo' => $row[1],
            'funcion' => $row[2],
            'id_seccion' => $row[3],
            'id_subseccion' => $row[4],
            'id_serie' => $row[5],
            'id_subserie' => $row[6]
        ]);*/
    }
}
