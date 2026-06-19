<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\Cabeceraccd;
use App\Models\Registrosccd;


class CuadrosExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Cabeceraccd::with('periodo', 'seccion', 'subseccion')->get();
        return Registrosccd::with('series', 'subseries', 'seccion', 'subseccion')->get();
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'No.',
            'Acto administrativo',
            'Funcion',
            'Sección',
            'Subsección',
            'Serie',
            'Subserie'
        ];
    }
    /*public function headings(): array
    {
        return [
            'ID',
            'Proceso',
            'Formato',
            'Código',
            'Versión',
            'Fecha',
            'Entidad Productora',
            'Oficina',
            'Periodo'
        ];
    }*/

    /**
    * @return array
    */
    public function map($registros): array
    {
        return [
            $registros->id,
            $registros->acto_administrativo,
            $registros->funcion,
            $registros->seccion->nombre ?? 'N/A',
            $registros->subseccion->nombre ?? 'N/A',
            $registros->serie->nombre ?? 'N/A',
            $registros->subserie->nombre ?? 'N/A'
        ];
    }

    /*public function map($cabecera): array
    {
        return [
            $cabecera->id,
            $cabecera->proceso,
            $registros->subseccion->nombre ?? 'N/A',
            $registros->periodo->nombre ?? 'N/A'
        ];
    }

    /*public function map($cabecera): array
    {
        return [
            $cabecera->id,
            $cabecera->proceso,
            $cabecera->formato,
            $cabecera->codigo,
            $cabecera->version,
            $cabecera->fecha,
            $cabecera->entidad_productora,
            $cabecera->subseccion->nombre ?? 'N/A',
            $cabecera->periodo->nombre ?? 'N/A'
        ];
    }*/

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $cellRange = 'A1:I1'; // Rango de celdas para el encabezado
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
