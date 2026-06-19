<?php

namespace App\Exports;

use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\DB;

use App\Models\Cabecerafuid;
use App\Models\Registrosfuid;

class FuidExport implements FromCollection, ShouldQueue, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;

    /*public function model(array $row): Registrosfuid
    {
        return new Registrosfuid([
            'Unidad documental' => $row['unidad_documental'],
            'Subserie' => $row['nombre_subserie'],
        ]);
    }*/

    public function chunkSize(): int
    {
        return 1000;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //eturn Registrosfuid::with('series', 'subseries', 'seccion', 'subseccion', 'periodo')->get();
        //return Registrosfuid::where('id_cabecerafuid', '=', 3, false)->first();
        //return Cabecerafuid::all();
        return DB::table('registrosfuid')->whereBetween('fecha_inicial', ['1992-01-01 00:00:00', '1997-12-30 23:59:59'])->get();
    }
    /**
    * @return array
    */
    /*public function query()
    {
        return Registrosfuid::where('id_cabecerafuid', '=', 3, false);
    }

    public function chunkSize(): int
    {
        return 1000;
    }*/

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'No.',
            'Serie',
            'Subserie',
            'Unidad documental',
            'Fecha Inical',
            'Fecha Final',
            'Soporte Físico',
            'Soporte Electrónico',
            'Caja',
            'Carpeta',
            'Tomo/Legajo/Libro',
            'Folios',
            'Código Barras Caja',
            'Código Barras Carpeta',
            'Sigatura Topografica',
            'Otro Tipo',
            'Otro Cantidad',
            'Electrónico Ubicación',
            'Electrónico Cantidad',
            'Electrónico Tamaño',
            'Notas'
        ];
    }

    /**
    * @return array
        */
    public function map($registros): array
    {
        return [
            $registros->id,
            $registros->series->nombre ?? 'N/A',
            $registros->subseries->nombre ?? 'N/A',
            $registros->unidad_documental,
            $registros->fecha_inicial,
            $registros->fecha_final,
            $registros->soporte_fisico,
            $registros->soporte_electronico,
            $registros->caja,
            $registros->carpeta,
            $registros->tomolegajolibro,
            $registros->folios,
            $registros->codigobarrascaja,
            $registros->codigobarrascarpeta,
            $registros->signatura_topografica,
            $registros->otro_tipo,
            $registros->otro_cantidad,
            $registros->electronico_ubicacion,
            $registros->electronico_cantidad,
            $registros->electronico_tamano,
            $registros->notas
        ];
    }

    /*public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $cellRange = 'A1:U1'; // Rango de celdas para el encabezado
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }*/
}