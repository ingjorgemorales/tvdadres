<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Request as RequestFacade; 
use App\Models\Consulta;
use App\Models\Seccion;
use App\Models\Subseccion;
use App\Models\Series;
use App\Models\Subseries;
use App\Models\Periodo;
use App\Models\Registrosfuid;
use App\Models\Cabecerafuid;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Cuadrosexport;
use App\Exports\FuidExport;
use Maatwebsite\Excel\Excel as BaseExcel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Process;

class ConsultaFuidController extends Controller
{
    public function index(Request $request) {

        $secciones = Seccion::all();
        $series = Series::all();
        $periodos = Periodo::all();
        $subsecciones = Subseccion::all();
        $subseries = Subseries::all();

        $count = count($request->input());
        $accion = $request->input('accion');
        if ($accion == "consultar") {

            $validated = $request->validate([
                'periodo' => 'required|min:1'
            ]);

            try {

                $fecha_inicial = $request->input('fecha_inicial');
                $fecha_final = $request->input('fecha_final');
                $periodo = $request->input('periodo');
                $seccion = $request->input('seccion');
                $subseccion = $request->input('subseccion');
                $serie = $request->input('serie');
                $subserie = $request->input('subserie');
                $caja = $request->input('caja');
                $carpeta = $request->input('carpeta');

                $query = Registrosfuid::query()
                    ->join('cabecerafuid', 'registrosfuid.id_cabecerafuid', '=', 'cabecerafuid.id')
                    ->join('periodos', 'cabecerafuid.id_periodo', '=', 'periodos.id')
                    ->join('seccion', 'cabecerafuid.id_seccion', '=', 'seccion.id')
                    ->join('subseccion', 'cabecerafuid.id_subseccion', '=', 'subseccion.id')
                    ->join('series', 'registrosfuid.id_serie', '=', 'series.id')
                    ->leftJoin('subseries', 'registrosfuid.id_subserie', '=', 'subseries.id')
                    ->select('registrosfuid.id', 'registrosfuid.id_cabecerafuid', 'registrosfuid.unidad_documental', 'registrosfuid.fecha_inicial', 'registrosfuid.fecha_final',
                        'registrosfuid.soporte_fisico', 'registrosfuid.soporte_electronico', 'registrosfuid.caja', 'registrosfuid.carpeta', 'registrosfuid.tomolegajolibro',
                        'registrosfuid.folios', 'registrosfuid.codigobarrascaja', 'registrosfuid.codigobarrascarpeta', 'registrosfuid.signatura_topografica', 'registrosfuid.otro_tipo',
                        'registrosfuid.otro_cantidad', 'registrosfuid.electronico_ubicacion', 'registrosfuid.electronico_cantidad', 'registrosfuid.electronico_tamano', 'registrosfuid.notas',
                        'cabecerafuid.proceso', 'cabecerafuid.formato', 'cabecerafuid.codigo', 'cabecerafuid.version', 'cabecerafuid.fecha', 'cabecerafuid.entidad_remitente',
                        'cabecerafuid.entidad_productora', 'cabecerafuid.objeto', 'seccion.codigo as seccion_codigo', 'seccion.nombre as seccion_nombre',
                        'subseccion.codigo as subseccion_codigo', 'subseccion.nombre as subseccion_nombre', 'series.codigo as serie_codigo', 'series.nombre as serie_nombre',
                        'subseries.codigo as subserie_codigo', 'subseries.nombre as subserie_nombre', 'periodos.nombre as nombre_periodo')
                    ->whereNotNull('registrosfuid.unidad_documental')
                    ->when($periodo, fn($q) => $q->where('cabecerafuid.id_periodo', $periodo))
                    ->when($seccion, fn($q) => $q->where('cabecerafuid.id_seccion', $seccion))
                    ->when($subseccion, fn($q) => $q->where('cabecerafuid.id_subseccion', $subseccion))
                    ->when($serie, fn($q) => $q->where('registrosfuid.id_serie', $serie))
                    ->when($subserie, fn($q) => $q->where('registrosfuid.id_subserie', $subserie))
                    ->when($fecha_inicial, fn($q) => $q->where('registrosfuid.fecha_inicial', '>=', $fecha_inicial))
                    ->when($fecha_final, fn($q) => $q->where('registrosfuid.fecha_final', '<=', $fecha_final))
                    ->when($caja, fn($q) => $q->where('registrosfuid.caja', $caja))
                    ->when($carpeta, fn($q) => $q->where('registrosfuid.carpeta', $carpeta));
                $resultados = $query->paginate(20)->withQueryString();
                $k = $resultados->count();

                $sql = $query->toSql();
                $bindings = $query->getBindings();
                $fullSql = Str::replaceArray('?', $bindings, $sql);

                //$i = ($resultados->currentPage() - 1) * $resultados->perPage();
                RequestFacade::flash();
                if ($k > 0) {
                    //Log::info("Consulta realizada con éxito. Número de resultados: " . $k . ' - ' . $fullSql);

                    return view('consultaFuid', compact('resultados', 'secciones', 'subsecciones', 'series', 'subseries', 'periodos', 'fecha_inicial', 'fecha_final', 'caja', 'carpeta'))
                    ->with('i', ($request->input('page', 1) - 1) * $resultados->perPage());
                    //->with('success', 'Consulta realizada con éxito. Número de resultados: ' . $k . '.');
                } else {
                    //Log::info("Consulta realizada, pero no se encontraron resultados.". $fullSql);

                    return view('consultaFuid', compact('resultados', 'secciones', 'subsecciones', 'series', 'subseries', 'periodos', 'fecha_inicial', 'fecha_final', 'caja', 'carpeta'))
                    ->with('success', 'Consulta realizada, pero no se encontraron resultados!');
                    //return back()->with('success', 'Consulta realizada, pero no se encontraron resultados! ');
                }
                //$resultados = Cabecerafuid::where('id_seccion', '=', $seccion, false)->get();
                //$resultados = Cabecerafuid::where('id_seccion', $seccion)->where('id_periodo', $periodo)->get();
                //return back()->with('informacion', 'Consulta realizada con éxito. Número de resultados: ' . $k);

                
                

            } catch (Exception $e) {
                Log::error('Error al exportar los datos: ' . $e->getMessage());

                //return response()->json(['error' => 'Error al exportar los datos'], 404);
                return back()->with('error', 'Error al exportar los datos');
            }
        } 
        else if ($accion == "exportar") {
            return $this->export($request);
        }       
        else {

            $caja = "";
            $carpeta = "";
            $fecha_inicial = $request->input('fecha_inicial', date('Y-m-d', strtotime('-1 year')));
            $fecha_final = $request->input('fecha_final', date('Y-m-d'));

            return view('consultaFuid', compact('secciones', 'subsecciones', 'series', 'subseries', 'periodos', 'fecha_inicial', 'fecha_final', 'caja', 'carpeta'));
        }
    }

    public function getRegistros()
    {
        $registros = Registrosfuid::query()
            ->join('cabecerafuid', 'registrosfuid.id_cabecerafuid', '=', 'cabecerafuid.id')
            ->join('periodos', 'cabecerafuid.id_periodo', '=', 'periodos.id')
            ->join('seccion', 'cabecerafuid.id_seccion', '=', 'seccion.id')
            ->join('subseccion', 'cabecerafuid.id_subseccion', '=', 'subseccion.id')
            ->join('series', 'registrosfuid.id_serie', '=', 'series.id')
            ->leftJoin('subseries', 'registrosfuid.id_subserie', '=', 'subseries.id')
            ->select('registrosfuid.*', 'cabecerafuid.proceso', 'cabecerafuid.formato', 'cabecerafuid.codigo', 'cabecerafuid.version', 'cabecerafuid.fecha', 
                    'cabecerafuid.entidad_remitente', 'cabecerafuid.entidad_productora', 'cabecerafuid.objeto',
                    'seccion.codigo as seccion_codigo', 'seccion.nombre as seccion_nombre',
                    'subseccion.codigo as subseccion_codigo', 'subseccion.nombre as subseccion_nombre',
                    'series.codigo as serie_codigo', 'series.nombre as serie_nombre',
                    'subseries.codigo as subserie_codigo', 'subseries.nombre as subserie_nombre',
                    'periodos.nombre as nombre_periodo')
            ->whereNotNull('registrosfuid.unidad_documental')
            ->where('cabecerafuid.id_periodo', 2)
            ->limit(100)
            ->get();        

        return DataTables::of($registros)
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        // 1. Validación
        /*$validated = $request->validate([
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
        $series = Series::all();
        $subseries = Subseries::all();
        $periodos = Periodo::all();

        try {

            $fecha_inicial = $request->input('fecha_inicial');
            $fecha_final = $request->input('fecha_final');
            $periodo = $request->input('periodo');
            $seccion = $request->input('seccion');
            $subseccion = $request->input('subseccion');
            $serie = $request->input('serie');
            $subserie = $request->input('subserie');

            $query = Registrosfuid::query()
                ->join('cabecerafuid', 'registrosfuid.id_cabecerafuid', '=', 'cabecerafuid.id')
                ->join('periodos', 'cabecerafuid.id_periodo', '=', 'periodos.id')
                ->join('seccion', 'cabecerafuid.id_seccion', '=', 'seccion.id')
                ->join('subseccion', 'cabecerafuid.id_subseccion', '=', 'subseccion.id')
                ->join('series', 'registrosfuid.id_serie', '=', 'series.id')
                ->leftJoin('subseries', 'registrosfuid.id_subserie', '=', 'subseries.id')
                ->select('registrosfuid.id', 'registrosfuid.id_cabecerafuid', 'registrosfuid.unidad_documental', 'registrosfuid.fecha_inicial', 'registrosfuid.fecha_final',
                    'registrosfuid.soporte_fisico', 'registrosfuid.soporte_electronico', 'registrosfuid.caja', 'registrosfuid.carpeta', 'registrosfuid.tomolegajolibro',
                    'registrosfuid.folios', 'registrosfuid.codigobarrascaja', 'registrosfuid.codigobarrascarpeta', 'registrosfuid.signatura_topografica', 'registrosfuid.otro_tipo',
                    'registrosfuid.otro_cantidad', 'registrosfuid.electronico_ubicacion', 'registrosfuid.electronico_cantidad', 'registrosfuid.electronico_tamano', 'registrosfuid.notas',
                    'cabecerafuid.proceso', 'cabecerafuid.formato', 'cabecerafuid.codigo', 'cabecerafuid.version', 'cabecerafuid.fecha', 'cabecerafuid.entidad_remitente',
                    'cabecerafuid.entidad_productora', 'cabecerafuid.objeto', 'seccion.codigo as seccion_codigo', 'seccion.nombre as seccion_nombre',
                    'subseccion.codigo as subseccion_codigo', 'subseccion.nombre as subseccion_nombre', 'series.codigo as serie_codigo', 'series.nombre as serie_nombre',
                    'subseries.codigo as subserie_codigo', 'subseries.nombre as subserie_nombre', 'periodos.nombre as nombre_periodo')
                ->whereNotNull('registrosfuid.unidad_documental')
                ->when($periodo, fn($q) => $q->where('cabecerafuid.id_periodo', $periodo))
                ->when($seccion, fn($q) => $q->where('cabecerafuid.id_seccion', $seccion))
                ->when($subseccion, fn($q) => $q->where('cabecerafuid.id_subseccion', $subseccion))
                ->when($serie, fn($q) => $q->where('registrosfuid.id_serie', $serie))
                ->when($subserie, fn($q) => $q->where('registrosfuid.id_subserie', $subserie));
            $resultados = $query->paginate(10)->withQueryString();
            $k = $resultados->count();
            //$i = ($resultados->currentPage() - 1) * $resultados->perPage();
            if ($k > 0) {
                Log::info("Consulta realizada con éxito. Número de resultados: " . $k);
            } else {
                Log::info("Consulta realizada, pero no se encontraron resultados.". $query->toSql());
            }
            //$resultados = Cabecerafuid::where('id_seccion', '=', $seccion, false)->get();
            //$resultados = Cabecerafuid::where('id_seccion', $seccion)->where('id_periodo', $periodo)->get();
            //return back()->with('informacion', 'Consulta realizada con éxito. Número de resultados: ' . $k);

            RequestFacade::flash();
            return view('consultaFuid', compact('resultados', 'secciones', 'subsecciones', 'series', 'subseries', 'periodos', 'fecha_inicial', 'fecha_final'))
                ->with('i', ($request->input('page', 1) - 1) * $resultados->perPage());

        } catch (Exception $e) {
            Log::error('Error al exportar los datos: ' . $e->getMessage());

            //return response()->json(['error' => 'Error al exportar los datos'], 404);
            return back()->with('error', 'Error al exportar los datos');
        }
    }

    private function export(Request $request) {

        $usuario = auth()->user(); 
        $usuario = Auth::user(); 
        $nombre = auth()->user()->name;
        $correo = auth()->user()->email;

        if (!File::exists(public_path($nombre))) {
            File::makeDirectory(public_path($nombre), 0755, true);
        }

        $directory = public_path($nombre);

        try {
            $fecha_inicial = $request->input('fecha_inicial');
            $fecha_final = $request->input('fecha_final');
            $periodo = $request->input('periodo');
            $seccion = $request->input('seccion');
            $subseccion = $request->input('subseccion');
            $serie = $request->input('serie');
            $subserie = $request->input('subserie');
            $caja = $request->input('caja');
            $carpeta = $request->input('carpeta');

            $resultadosc = Registrosfuid::query()
                ->join('cabecerafuid', 'registrosfuid.id_cabecerafuid', '=', 'cabecerafuid.id')
                ->join('periodos', 'cabecerafuid.id_periodo', '=', 'periodos.id')
                ->join('seccion', 'cabecerafuid.id_seccion', '=', 'seccion.id')
                ->join('subseccion', 'cabecerafuid.id_subseccion', '=', 'subseccion.id')
                ->join('series', 'registrosfuid.id_serie', '=', 'series.id')
                ->leftJoin('subseries', 'registrosfuid.id_subserie', '=', 'subseries.id')
                ->select('registrosfuid.id', 'registrosfuid.id_cabecerafuid', 'registrosfuid.unidad_documental', 'registrosfuid.fecha_inicial', 'registrosfuid.fecha_final',
                    'registrosfuid.soporte_fisico', 'registrosfuid.soporte_electronico', 'registrosfuid.caja', 'registrosfuid.carpeta', 'registrosfuid.tomolegajolibro',
                    'registrosfuid.folios', 'registrosfuid.codigobarrascaja', 'registrosfuid.codigobarrascarpeta', 'registrosfuid.signatura_topografica', 'registrosfuid.otro_tipo',
                    'registrosfuid.otro_cantidad', 'registrosfuid.electronico_ubicacion', 'registrosfuid.electronico_cantidad', 'registrosfuid.electronico_tamano', 'registrosfuid.notas',
                    'cabecerafuid.proceso', 'cabecerafuid.formato', 'cabecerafuid.codigo', 'cabecerafuid.version', 'cabecerafuid.fecha', 'cabecerafuid.entidad_remitente',
                    'cabecerafuid.entidad_productora', 'cabecerafuid.objeto', 'seccion.codigo as seccion_codigo', 'seccion.nombre as seccion_nombre',
                    'subseccion.codigo as subseccion_codigo', 'subseccion.nombre as subseccion_nombre', 'series.codigo as serie_codigo', 'series.nombre as serie_nombre',
                    'subseries.codigo as subserie_codigo', 'subseries.nombre as subserie_nombre', 'periodos.nombre as nombre_periodo')
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

            if ($resultadosc > 10000) {
                flash('La cantidad de registros es demasiado grande. Se exportarán ' . $resultadosc . ' registros. Por favor espere a que el archivo se genere y consúltelo en el módulo de Archivos. ', 'alert alert-success');
                $this->exportbat($request);
                return back();
            } elseif ($resultadosc == 0) {
                return back()->with('information', 'No se encontraron resultados para generar el archivo.');
            }

            $resultados = Registrosfuid::query()
                ->join('cabecerafuid', 'registrosfuid.id_cabecerafuid', '=', 'cabecerafuid.id')
                ->join('periodos', 'cabecerafuid.id_periodo', '=', 'periodos.id')
                ->join('seccion', 'cabecerafuid.id_seccion', '=', 'seccion.id')
                ->join('subseccion', 'cabecerafuid.id_subseccion', '=', 'subseccion.id')
                ->join('series', 'registrosfuid.id_serie', '=', 'series.id')
                ->leftJoin('subseries', 'registrosfuid.id_subserie', '=', 'subseries.id')
                ->select('registrosfuid.id', 'registrosfuid.id_cabecerafuid', 'registrosfuid.unidad_documental', 'registrosfuid.fecha_inicial', 'registrosfuid.fecha_final',
                    'registrosfuid.soporte_fisico', 'registrosfuid.soporte_electronico', 'registrosfuid.caja', 'registrosfuid.carpeta', 'registrosfuid.tomolegajolibro',
                    'registrosfuid.folios', 'registrosfuid.codigobarrascaja', 'registrosfuid.codigobarrascarpeta', 'registrosfuid.signatura_topografica', 'registrosfuid.otro_tipo',
                    'registrosfuid.otro_cantidad', 'registrosfuid.electronico_ubicacion', 'registrosfuid.electronico_cantidad', 'registrosfuid.electronico_tamano', 'registrosfuid.notas',
                    'cabecerafuid.proceso', 'cabecerafuid.formato', 'cabecerafuid.codigo', 'cabecerafuid.version', 'cabecerafuid.fecha', 'cabecerafuid.entidad_remitente',
                    'cabecerafuid.entidad_productora', 'cabecerafuid.objeto', 'seccion.codigo as seccion_codigo', 'seccion.nombre as seccion_nombre',
                    'subseccion.codigo as subseccion_codigo', 'subseccion.nombre as subseccion_nombre', 'series.codigo as serie_codigo', 'series.nombre as serie_nombre',
                    'subseries.codigo as subserie_codigo', 'subseries.nombre as subserie_nombre', 'periodos.nombre as nombre_periodo')
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
                ->get();

            $rutaPlantilla = str_replace('\\', '/', public_path('plantillas/' . 'Formato_FUID.xlsx'));
            $documento = IOFactory::load($rutaPlantilla);
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

            $numero = 1;
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
                    $subserienom = $resultado->serie_nombre . ' / '. $resultado->subserie_nombre;
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

            $nomarchivo = $periodo . ' PERIODO FUID_' . date('Ymdhis') . '.xlsx';
            $writer = new Xlsx($documento);
            $writer->save($directory . '/' . $nomarchivo);

            return back()->with('success', 'Archivo generado exitosamente! ' . $nomarchivo);

        } catch (Exception $e) {
            Log::error('Error al exportar los datos: ' . $e->getMessage());

            //return response()->json(['error' => 'Error al exportar los datos'], 404);
            return back()->with('error', 'Error al exportar los datos');
        }
        /*return Excel::download(new FuidExport, 'FUID.xlsx', BaseExcel::XLSX, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ]);*/

        //Descraga a disco
        /*return Excel::store(new CuadrosExport, 'cuadros.xlsx', 'public', BaseExcel::XLSX, [
            'visibility' => 'private'
        ]);*/

        /*return (new CuadrosExport)->download('cuadros.xlsx');*/

        /*return (new CuadrosExport)->store('cuadros.xlsx');*/
        /*header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="reporte_masivo.csv"');

        $output = fopen('php://output', 'w');
        fputs($output, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));
        fputcsv($output, ['No.',
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
            'Notas']);

        $pdo = DB::connection()->getPdo();
        $tamanioLote = 50000; // Procesar 50000 registros a la vez
        $offset = 0;

        do {
            $stmt = $pdo->prepare("SELECT id_cabecerafuid, orden, id_serie, id_subserie, unidad_documental, fecha_inicial, fecha_final, soporte_fisico, soporte_electronico, caja, carpeta, tomolegajolibro, folios, codigobarrascaja, codigobarrascarpeta, signatura_topografica, otro_tipo, otro_cantidad, electronico_ubicacion, electronico_cantidad, electronico_tamano, notas FROM registrosfuid LIMIT $tamanioLote OFFSET $offset");
            //$stmt->bindParam(':limit', $tamanioLote, PDO::PARAM_INT);
            //$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            
            $registros = $stmt->fetchAll();

            foreach ($registros as $fila) {
                // Escribir cada fila directamente al búfer de salida
                fputcsv($output, $fila);
            }

            // Limpiar la memoria antes del siguiente lote
            unset($registros);
            $offset += $tamanioLote;

        } while (count($registros) > 0);

        fclose($output);*/
    }

    public function exportbat(Request $request) {

        $usuario = auth()->user(); 
        $usuario = Auth::user(); 
        $nombre = auth()->user()->name;
        $correo = auth()->user()->email;

        $nombre = str_replace(' ', '_', $nombre);
        $fechaact = date("YmdHis");

        $fecha_inicial = $request->input('fecha_inicial') ?: '-';
        $fecha_final = $request->input('fecha_final') ?: '-';
        $periodo = $request->input('periodo') ?: '-';
        $seccion = $request->input('seccion') ?: '-';
        $subseccion = $request->input('subseccion') ?: '-';
        $serie = $request->input('serie') ?: '-';
        $subserie = $request->input('subserie') ?: '-';
        $caja = $request->input('caja') ?: '-';
        $carpeta = $request->input('carpeta') ?: '-';

        $phpPath = PHP_BINARY;
        $php_filename = public_path("\genera_FUID.php");
        //$php_filename = "C:\Apache246\htdocs\inventarios\inventarios\genera_FUID.php";
        $bat_filename = public_path("\generar_FUID.bat");
        $bat_log_filename = public_path("genera_FUID_".$fechaact.".log");
        $bat_file = fopen($bat_filename, "w");
        if($bat_file) {
            fwrite($bat_file, "@ECHO OFF"."\n");
            fwrite($bat_file, 'C:\Apache246\php\php-win.exe -f ' . $php_filename . ' ' . $fecha_inicial.' '.$fecha_final.' '.$periodo.' '.$seccion.' '.$subseccion.' '.$serie.' '.$subserie.' '.$caja.' '.$carpeta.' '.$nombre.' >> '.$bat_log_filename."\n");
            //fwrite($bat_file, "echo End process >> ".$bat_log_filename."\n");
            //fwrite($bat_file, "EXIT"."\n");
            fclose($bat_file);
        }
        // Start the process in the background
        $exe = "start /b ".$bat_filename;
        if( pclose(popen($exe, 'r')) ) {
            return true;
        }
        return false;

    }
}
