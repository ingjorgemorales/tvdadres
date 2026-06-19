<?php

ini_set('set_time_limit', 0);
ini_set('display_errors', 1);
ini_set('max_execution_time', '0');
ini_set('memory_limit', '1024M');

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Symfony\Component\Cache\Adapter\NullAdapter;
use Symfony\Component\Cache\Psr16Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Registrosfuid;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\IOFactory;
//use PhpOffice\PhpSpreadsheet\Collection\Cells\Memory\DevNull;
use PhpOffice\PhpSpreadsheet\Settings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Reader\IReader;

//$cache = new \PhpOffice\PhpSpreadsheet\Collection\Cells\Memory\Psr16(); // or use a PSR-16 cache pool
//Settings::setCache($cache);

/*$nullAdapter = new NullAdapter();
$cache = new Psr16Cache($nullAdapter);
Settings::setCache($cache);
Settings::getCache()->clear();*/

//$reader = IOFactory::createReader('Xlsx');
//$reader->setReadDataOnly(true);
//$reader->setReadEmptyCells(false); // Skips empty cells to save memory

$nombre = "";
$fecha_inicial = "";
$fecha_final = "";
$periodo = "";
$seccion = "";
$subseccion = "";
$serie = "";
$subserie = "";
$caja = "";
$carpeta = "";

try {

    if (isset($argc)) {
        for ($i = 0; $i < $argc; $i++) {
            if ($i == 1) {
                $fecha_inicial = $argv[$i];
                if ($fecha_inicial == "-") {
                    $fecha_inicial = "";
                }
            }
            if ($i == 2) {
                $fecha_final = $argv[$i];
                if ($fecha_final == "-") {
                    $fecha_final = "";
                }
            }
            if ($i == 3) {
                $periodo = $argv[$i];
                if ($periodo == "-") {
                    $periodo = "";
                }
            }
            if ($i == 4) {
                $seccion = $argv[$i];
                if ($seccion == "-") {
                    $seccion = "";
                }
            }
            if ($i == 5) {
                $subseccion = $argv[$i];
                if ($subseccion == "-") {
                    $subseccion = "";
                }
            }
            if ($i == 6) {
                $serie = $argv[$i];
                if ($serie == "-") {
                    $serie = "";
                }
            }
            if ($i == 7) {
                $subserie = $argv[$i];
                if ($subserie == "-") {
                    $subserie = "";
                }
            }
            if ($i == 8) {
                $caja = $argv[$i];
                if ($caja == "-") {
                    $caja = "";
                }
            }
            if ($i == 9) {
                $carpeta = $argv[$i];
                if ($carpeta == "-") {
                    $carpeta = "";
                }
            }
            if ($i == 10) {
                $nombre = $argv[$i];
                if ($nombre == "-") {
                    $nombre = "";
                } else {
                    $nombre = str_replace('_', ' ', $nombre);
                }
            }
            echo "Argument #" . $i . " - " . $argv[$i] . "\n";
        }
    } else {
        echo "argc and argv disabled\n";
    }

    if (!File::exists(public_path($nombre))) {
        File::makeDirectory(public_path($nombre), 0755, true);
    }

    $directory = public_path($nombre);
    
    $resultadosc = Registrosfuid::query()
        ->join('cabecerafuid', 'registrosfuid.id_cabecerafuid', '=', 'cabecerafuid.id')
        ->join('periodos', 'cabecerafuid.id_periodo', '=', 'periodos.id')
        ->join('seccion', 'cabecerafuid.id_seccion', '=', 'seccion.id')
        ->join('subseccion', 'cabecerafuid.id_subseccion', '=', 'subseccion.id')
        ->join('series', 'registrosfuid.id_serie', '=', 'series.id')
        ->leftJoin('subseries', 'registrosfuid.id_subserie', '=', 'subseries.id')
        ->select(
            'registrosfuid.id',
            'registrosfuid.id_cabecerafuid',
            'registrosfuid.unidad_documental',
            'registrosfuid.fecha_inicial',
            'registrosfuid.fecha_final',
            'registrosfuid.soporte_fisico',
            'registrosfuid.soporte_electronico',
            'registrosfuid.caja',
            'registrosfuid.carpeta',
            'registrosfuid.tomolegajolibro',
            'registrosfuid.folios',
            'registrosfuid.codigobarrascaja',
            'registrosfuid.codigobarrascarpeta',
            'registrosfuid.signatura_topografica',
            'registrosfuid.otro_tipo',
            'registrosfuid.otro_cantidad',
            'registrosfuid.electronico_ubicacion',
            'registrosfuid.electronico_cantidad',
            'registrosfuid.electronico_tamano',
            'registrosfuid.notas',
            'cabecerafuid.proceso',
            'cabecerafuid.formato',
            'cabecerafuid.codigo',
            'cabecerafuid.version',
            'cabecerafuid.fecha',
            'cabecerafuid.entidad_remitente',
            'cabecerafuid.entidad_productora',
            'cabecerafuid.objeto',
            'seccion.codigo as seccion_codigo',
            'seccion.nombre as seccion_nombre',
            'subseccion.codigo as subseccion_codigo',
            'subseccion.nombre as subseccion_nombre',
            'series.codigo as serie_codigo',
            'series.nombre as serie_nombre',
            'subseries.codigo as subserie_codigo',
            'subseries.nombre as subserie_nombre',
            'periodos.nombre as nombre_periodo'
        )
        ->whereNotNull('registrosfuid.unidad_documental')
        ->when($periodo, fn($q) => $q->where('cabecerafuid.id_periodo', $periodo))
        ->when($seccion, fn($q) => $q->where('cabecerafuid.id_seccion', $seccion))
        ->when($subseccion, fn($q) => $q->where('cabecerafuid.id_subseccion', $subseccion))
        ->when($serie, fn($q) => $q->where('registrosfuid.id_serie', $serie))
        ->when($subserie, fn($q) => $q->where('registrosfuid.id_subserie', $subserie))
        ->when($fecha_inicial, fn($q) => $q->where('registrosfuid.fecha_inicial', '>=', $fecha_inicial))
        ->when($fecha_final, fn($q) => $q->where('registrosfuid.fecha_final', '<=', $fecha_final))
        ->when($caja, fn($q) => $q->where('registrosfuid.caja', $caja))
        ->when($carpeta, fn($q) => $q->where('registrosfuid.carpeta', $carpeta))
        ->count();
    
    $registrosPorPagina = 10000;
    $paginas = ceil($resultadosc / $registrosPorPagina);
    for ($i = 1; $i <= $paginas; $i++) {
        
        $resultados = Registrosfuid::query()
            ->join('cabecerafuid', 'registrosfuid.id_cabecerafuid', '=', 'cabecerafuid.id')
            ->join('periodos', 'cabecerafuid.id_periodo', '=', 'periodos.id')
            ->join('seccion', 'cabecerafuid.id_seccion', '=', 'seccion.id')
            ->join('subseccion', 'cabecerafuid.id_subseccion', '=', 'subseccion.id')
            ->join('series', 'registrosfuid.id_serie', '=', 'series.id')
            ->leftJoin('subseries', 'registrosfuid.id_subserie', '=', 'subseries.id')
            ->select(
                'registrosfuid.id',
                'registrosfuid.id_cabecerafuid',
                'registrosfuid.unidad_documental',
                'registrosfuid.fecha_inicial',
                'registrosfuid.fecha_final',
                'registrosfuid.soporte_fisico',
                'registrosfuid.soporte_electronico',
                'registrosfuid.caja',
                'registrosfuid.carpeta',
                'registrosfuid.tomolegajolibro',
                'registrosfuid.folios',
                'registrosfuid.codigobarrascaja',
                'registrosfuid.codigobarrascarpeta',
                'registrosfuid.signatura_topografica',
                'registrosfuid.otro_tipo',
                'registrosfuid.otro_cantidad',
                'registrosfuid.electronico_ubicacion',
                'registrosfuid.electronico_cantidad',
                'registrosfuid.electronico_tamano',
                'registrosfuid.notas',
                'cabecerafuid.proceso',
                'cabecerafuid.formato',
                'cabecerafuid.codigo',
                'cabecerafuid.version',
                'cabecerafuid.fecha',
                'cabecerafuid.entidad_remitente',
                'cabecerafuid.entidad_productora',
                'cabecerafuid.objeto',
                'seccion.codigo as seccion_codigo',
                'seccion.nombre as seccion_nombre',
                'subseccion.codigo as subseccion_codigo',
                'subseccion.nombre as subseccion_nombre',
                'series.codigo as serie_codigo',
                'series.nombre as serie_nombre',
                'subseries.codigo as subserie_codigo',
                'subseries.nombre as subserie_nombre',
                'periodos.nombre as nombre_periodo'
            )
            ->whereNotNull('registrosfuid.unidad_documental')
            ->when($periodo, fn($q) => $q->where('cabecerafuid.id_periodo', $periodo))
            ->when($seccion, fn($q) => $q->where('cabecerafuid.id_seccion', $seccion))
            ->when($subseccion, fn($q) => $q->where('cabecerafuid.id_subseccion', $subseccion))
            ->when($serie, fn($q) => $q->where('registrosfuid.id_serie', $serie))
            ->when($subserie, fn($q) => $q->where('registrosfuid.id_subserie', $subserie))
            ->when($fecha_inicial, fn($q) => $q->where('registrosfuid.fecha_inicial', '>=', $fecha_inicial))
            ->when($fecha_final, fn($q) => $q->where('registrosfuid.fecha_final', '<=', $fecha_final))
            ->when($caja, fn($q) => $q->where('registrosfuid.caja', $caja))
            ->when($carpeta, fn($q) => $q->where('registrosfuid.carpeta', $carpeta))
            ->limit($registrosPorPagina)
            ->offset(($i - 1) * $registrosPorPagina)
            ->get();
        
        $rutaPlantilla = str_replace('\\', '/', public_path('plantillas/' . 'Formato_FUID.xlsx'));
        
        $documento = IOFactory::load($rutaPlantilla, IReader::READ_DATA_ONLY | IReader::IGNORE_EMPTY_CELLS);
        $documento->setActiveSheetIndex(0);
        $hoja = $documento->getActiveSheet();
        $hoja->setCellValue('D5', $resultados[0]->entidad_remitente);
        $hoja->setCellValue('D6', $resultados[0]->entidad_productora);
        $hoja->setCellValue('D7', '(' . $resultados[0]->seccion_codigo . ') ' . $resultados[0]->seccion_nombre);
        $hoja->setCellValue('D8', '(' . $resultados[0]->subseccion_codigo . ') ' . $resultados[0]->subseccion_nombre);
        $hoja->setCellValue('D9', $resultados[0]->objeto);

        $hoja->setCellValue('S8', date('Y'));
        $hoja->setCellValue('T8', date('m'));
        $hoja->setCellValue('U8', date("d"));

        $numero = ($i - 1) * $registrosPorPagina;
        $row = 14;
        // Ajustar ancho de columnas
        $hoja->getColumnDimension('B')->setWidth(8);
        $hoja->getColumnDimension('C')->setWidth(18);
        $hoja->getColumnDimension('D')->setWidth(40);
        $hoja->getColumnDimension('E')->setWidth(40);
        $hoja->getColumnDimension('F')->setWidth(18);
        $hoja->getColumnDimension('G')->setWidth(18);
        $hoja->getColumnDimension('H')->setWidth(12);
        $hoja->getColumnDimension('I')->setWidth(14);
        $hoja->getColumnDimension('J')->setWidth(12);
        $hoja->getColumnDimension('K')->setWidth(10);
        $hoja->getColumnDimension('L')->setWidth(16);
        $hoja->getColumnDimension('M')->setWidth(12);
        $hoja->getColumnDimension('N')->setWidth(15);
        $hoja->getColumnDimension('O')->setWidth(15);
        $hoja->getColumnDimension('P')->setWidth(18);
        $hoja->getColumnDimension('Q')->setWidth(12);
        $hoja->getColumnDimension('R')->setWidth(12);
        $hoja->getColumnDimension('S')->setWidth(18);
        $hoja->getColumnDimension('T')->setWidth(12);
        $hoja->getColumnDimension('U')->setWidth(12);
        $hoja->getColumnDimension('V')->setWidth(20);
        $totalFilas = count($resultados);
        if ($totalFilas > 1) {
            $hoja->insertNewRowBefore($row, $totalFilas - 1);
            $hoja->duplicateStyle($hoja->getStyle('B' . $row . ':V' . $row), 'B' . ($row + 1) . ':V' . ($row + $totalFilas - 1));
        }

        foreach ($resultados as $resultado) {
            $codigocol = $resultado->subseccion_codigo . '.' . $resultado->serie_codigo;
            if ($resultado->subserie_codigo !== '') {
                $codigocol .= '.' . $resultado->subserie_codigo;
            }
            $soportefis = "";
            $soporteele = "";
            $subserienom = "";
            if ($resultado->soporte_fisico == 1) {
                $soportefis = "X";
            } else {
                $soportefis = "";
            }
            if ($resultado->soporte_electronico == 1) {
                $soporteele = "X";
            } else {
                $soporteele = "";
            }
            if ($resultado->subserie_nombre == '') {
                $subserienom = $resultado->serie_nombre;
            } else {
                $subserienom = $resultado->serie_nombre . ' / ' . $resultado->subserie_nombre;
            }
            $hoja->setCellValue('B' . $row, $numero);
            $hoja->setCellValue('C' . $row, $codigocol);
            $hoja->setCellValue('D' . $row, $subserienom);
            $hoja->setCellValue('E' . $row, $resultado->unidad_documental);
            $hoja->setCellValue('F' . $row, date('d-m-Y', strtotime($resultado->fecha_inicial)));
            $hoja->setCellValue('G' . $row, date('d-m-Y', strtotime($resultado->fecha_final)));
            $hoja->setCellValue('H' . $row, $soportefis);
            $hoja->setCellValue('I' . $row, $soporteele);
            $hoja->setCellValue('J' . $row, $resultado->caja);
            $hoja->setCellValue('K' . $row, $resultado->carpeta);
            $hoja->setCellValue('L' . $row, $resultado->tomolegajolibro);
            $hoja->setCellValue('M' . $row, $resultado->folios);
            $hoja->setCellValue('N' . $row, $resultado->codigobarrascaja);
            $hoja->setCellValue('O' . $row, $resultado->codigobarrascarpeta);
            $hoja->setCellValue('P' . $row, $resultado->signatura_topografica);
            $hoja->setCellValue('Q' . $row, $resultado->otro_tipo);
            $hoja->setCellValue('R' . $row, $resultado->otro_cantidad);
            $hoja->setCellValue('S' . $row, $resultado->electronico_ubicacion);
            $hoja->setCellValue('T' . $row, $resultado->electronico_cantidad);
            $hoja->setCellValue('U' . $row, $resultado->electronico_tamano);
            $hoja->setCellValue('V' . $row, $resultado->notas);

            $documento->getActiveSheet()->getStyle('D' . $row . ':E' . $row)->getAlignment()->applyFromArray([
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
                'textRotation' => 0,       // Rotación en grados (número entero)
                'wrapText' => true
            ]);
            $documento->getActiveSheet()->getStyle('V' . $row)->getAlignment()->applyFromArray([
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
                'textRotation' => 0,       // Rotación en grados (número entero)
                'wrapText' => true
            ]);
            //$hoja->getStyle('B' . $row . ':V' . $row)->getAlignment()->setWrapText(true);
            //$hoja->getRowDimension($row)->setRowHeight(-1);
            $numero++;
            $row++;
        }

        $nomarchivo = $periodo . ' PERIODO FUID_' . date('Ymdhis') . '_' . $i .'.xlsx';
        $writer = new Xlsx($documento);
        $writer->save($directory . '/' . $nomarchivo);

        $documento->disconnectWorksheets();
        unset($documento);
        gc_collect_cycles();

        //Log::success('Se generó el archivo ' . $nomarchivo . ' exitosamente: ');
    }
        
} catch (Exception $e) {
    //Log::error('Error al exportar los datos: ' . $e->getMessage());
}

?>