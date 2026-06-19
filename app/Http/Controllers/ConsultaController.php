<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as RequestFacade; 
use App\Models\Cabeceraccd;
use App\Models\Periodo;
use App\Models\Seccion;
use App\Models\Subseccion;
use App\Models\Series;
use App\Models\Subseries;
use App\Exports\CuadrosExport;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ConsultaController extends Controller
{
    public function index() {
        $secciones = Seccion::all();
        $periodos = Periodo::all();
        $series = Series::all();
        $subseries = Subseries::all();        
        return view('consulta', compact('secciones', 'periodos', 'series', 'subseries'));
    }

    public function store(Request $request) {
        // 1. Validación
        /*$validated = $request->validate([
            'proceso' => 'required|min:3',
            'fecha' => 'required|min:10',
            'periodo' => 'required|min:3',
            'seccion' => 'required|min:3',
            'subseccion' => 'required|min:3',
            'serie' => 'required|min:3',
            'subserie' => 'required|min:3'
        ]);*/

        $validated = $request->validate([
            'periodo' => 'required|min:1'
        ]);

        $i = 0;
        $secciones = Seccion::all();
        $subsecciones = Subseccion::all();
        $periodos = Periodo::all();
        $series = Series::all();
        $subseries = Subseries::all();    
        
        //$proceso = $request->input('proceso');
        //$fecha = $request->input('fecha');
        $periodo = $request->input('periodo');
        $seccion = $request->input('seccion');
        $subseccion = $request->input('subseccion');
        $serie = $request->input('serie');
        $subserie = $request->input('subserie');

        $query = "SELECT l.id, l.id_cabeceraccd, l.acto_administrativo, l.funcion, ss.nombre as subseccion_nombre, s.codigo as seccion_codigo, s.nombre as seccion_nombre, ss.codigo as subseccion_codigo, se.codigo as serie_codigo, se.nombre as serie_nombre, su.codigo as subserie_codigo, su.nombre as subserie_nombre,
                    c.proceso, c.formato, c.entidad_productora, p.nombre as nombre_periodo, c.codigo, c.version
                FROM registrosccd l INNER JOIN cabeceraccd c ON l.id_cabeceraccd = c.id
                    INNER JOIN periodos p ON c.id_periodo = p.id
                    INNER JOIN seccion s ON l.id_seccion = s.id
                    INNER JOIN subseccion ss ON l.id_subseccion = ss.id
                    INNER JOIN series se ON l.id_serie = se.id
                    LEFT JOIN subseries su ON l.id_subserie = su.id
                WHERE l.acto_administrativo is not null ";
        if ($periodo) {
            $query .= " AND c.id_periodo = $periodo ";
        }
        if ($seccion) {
            $query .= " AND l.id_seccion = $seccion ";
        }
        if ($subseccion) {
            $query .= " AND l.id_subseccion = $subseccion ";
        }
        if ($serie) {
            $query .= " AND l.id_serie = $serie ";
        }
        if ($subserie) {
            $query .= " AND l.id_subserie = $subserie ";
        }

        $resultados = DB::select($query);
        //$resultados = Cabeceraccd::where('id_periodo', '=', $periodo, false)->get();

        RequestFacade::flash();
        return view('consulta', compact('resultados', 'periodos', 'secciones', 'subsecciones', 'subseccion', 'series', 'subseries', 'i'));
    }

    public function export(Request $request) {

        $usuario = auth()->user(); 
        $usuario = Auth::user(); 
        $nombre = auth()->user()->name;
        $correo = auth()->user()->email;

        if (!File::exists(public_path($nombre))) {
            File::makeDirectory(public_path($nombre), 0755, true);
        }

        $directory = public_path($nombre);

        try {
            $periodo = $request->input('periodo');
            $seccion = $request->input('seccion');
            $subseccion = $request->input('subseccion');
            $serie = $request->input('serie');
            $subserie = $request->input('subserie');

            $query = "SELECT l.id, l.id_cabeceraccd, l.acto_administrativo, l.funcion, ss.nombre as subseccion_nombre, s.codigo as seccion_codigo, s.nombre as seccion_nombre, ss.codigo as subseccion_codigo, se.codigo as serie_codigo, se.nombre as serie_nombre, su.codigo as subserie_codigo, su.nombre as subserie_nombre,
                    c.proceso, c.formato, c.entidad_productora, p.nombre as nombre_periodo, p.fecha_inicial, p.fecha_final, c.codigo, c.version
                FROM registrosccd l INNER JOIN cabeceraccd c ON l.id_cabeceraccd = c.id
                    INNER JOIN periodos p ON c.id_periodo = p.id
                    INNER JOIN seccion s ON l.id_seccion = s.id
                    INNER JOIN subseccion ss ON l.id_subseccion = ss.id
                    INNER JOIN series se ON l.id_serie = se.id
                    LEFT JOIN subseries su ON l.id_subserie = su.id
                WHERE l.acto_administrativo is not null ";
            if ($periodo) {
                $query .= " AND c.id_periodo = $periodo ";
            }
            if ($seccion) {
                $query .= " AND l.id_seccion = $seccion ";
            }
            if ($subseccion) {
                $query .= " AND l.id_subseccion = $subseccion ";
            }
            if ($serie) {
                $query .= " AND l.id_serie = $serie ";
            }
            if ($subserie) {
                $query .= " AND l.id_subserie = $subserie ";
            }

            $resultados = DB::select($query);

            if (count($resultados) === 0) {
                return back()->with('information', 'No se encontraron resultados para generar el archivo.');
            }
            //$rutaPlantilla = public_path('uploads') . '\\Formato_CCD.xlsx';
            $rutaPlantilla = str_replace('\\', '/', public_path('plantillas/' . 'Formato_CCD.xlsx'));


            $documento = IOFactory::createReader('Xlsx');
            $spreadsheet = $documento->load($rutaPlantilla);
            $hoja = $spreadsheet->getActiveSheet();

            //$documento = IOFactory::load($rutaPlantilla);
            //$documento->setActiveSheetIndex(0);
            //$hoja = $documento->getActiveSheet();

            $valorPlantillaA5 = $hoja->getCell('A5')->getValue();
            $hoja->setCellValue('A5', $valorPlantillaA5 . 'MINISTERIO DE SALUD / FONDO DE SOLIDARIDAD Y GARANTIA FOSYGA PERIODO ' . $periodo . ' : (' . date('d/m/Y', strtotime($resultados[0]->fecha_inicial)) . ' - ' . date('d/m/Y', strtotime($resultados[0]->fecha_final)) . ')');
            $hoja->setCellValue('J3', 'Fecha: ' . date('d/m/Y'));

            $row = 8; 
            // Ajustar ancho de columnas
            //$hoja->getColumnDimension('A')->setWidth(80);
            $hoja->getColumnDimension('B')->setWidth(25);
            $hoja->getColumnDimension('C')->setWidth(12);
            $hoja->getColumnDimension('D')->setWidth(25);
            $hoja->getColumnDimension('E')->setWidth(12);
            $hoja->getColumnDimension('F')->setWidth(25);
            $hoja->getColumnDimension('G')->setWidth(12);
            $hoja->getColumnDimension('H')->setWidth(25);
            $hoja->getColumnDimension('I')->setWidth(12);
            //$hoja->getColumnDimension('J')->setWidth(25);

            $totalFilas = count($resultados);
            if ($totalFilas > 1) {
                $hoja->insertNewRowBefore($row + 1, $totalFilas - 1);
                $hoja->duplicateStyle($hoja->getStyle('B' . $row . ':J' . $row), 'B' . ($row + 1) . ':J' . ($row + $totalFilas - 1));
            }

            foreach ($resultados as $resultado) {    
                $hoja->setCellValue('A' . $row, $resultado->acto_administrativo);
                $hoja->setCellValue('B' . $row, $resultado->funcion);
                $hoja->setCellValue('C' . $row, $resultado->seccion_codigo);
                $hoja->setCellValue('D' . $row, $resultado->seccion_nombre);
                $hoja->setCellValue('E' . $row, $resultado->subseccion_codigo);
                $hoja->setCellValue('F' . $row, $resultado->subseccion_nombre);
                $hoja->setCellValue('G' . $row, $resultado->serie_codigo);
                $hoja->setCellValue('H' . $row, $resultado->serie_nombre);
                $hoja->setCellValue('I' . $row, $resultado->subserie_codigo);
                $hoja->setCellValue('J' . $row, $resultado->subserie_nombre);
                $hoja->getStyle('A' . $row . ':J' . $row)->getAlignment()->setWrapText(true);
                $hoja->getRowDimension($row)->setRowHeight(-1);
                $row++;
            }

            /*header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="Reporte_Generado.xlsx"');
            header('Cache-Control: max-age=0');*/

            $nomarchivo = 'CCD - ' . $periodo . ' - PERIODO TVD_' . date('YmdHis') . '.xlsx';
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            //$writer = new Xlsx($documento);
            $writer->save($directory . '/' . $nomarchivo);
            //$writer->save('php://output');
            //exit;

            return back()->with('success', 'Archivo generado exitosamente! ' . $nomarchivo);

        } catch (Exception $e) {
            Log::error('Error al exportar los datos: ' . $e->getMessage());

            //return response()->json(['error' => 'Error al exportar los datos'], 404);
            return back()->with('error', 'Error al exportar los datos.' . $e->getMessage());
        }

        /*return Excel::download(new CuadrosExport, 'cuadros.xlsx', BaseExcel::XLSX, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ]);*/

        //Descraga a disco
        /*return Excel::store(new CuadrosExport, 'cuadros.xlsx', 'public', BaseExcel::XLSX, [
            'visibility' => 'private'
        ]);*/

        /*return (new CuadrosExport)->download('cuadros.xlsx');*/

        /*return (new CuadrosExport)->store('cuadros.xlsx');*/
    }
}
