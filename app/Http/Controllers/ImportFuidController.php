<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImportFuidController extends Controller
{
    public function index() {
        return view('Importar.ImportFuid');
    }

    public function importcsv(Request $request) {

        $request->validate([
            'filecsv' => 'required|file|mimes:csv,txt',
        ]);
        //$filename = $request->file('filecsv')->getClientOriginalName();
        //$request->file('filecsv')->move(public_path('uploads'), $filename);

        if ($request->hasFile('filecsv')) {
            $file = $request->file('filecsv');
            $filename = $file->getClientOriginalName();
            // Se guarda en storage/app/public/uploads/nombre_original.ext
            //$path = $file->copy('uploads', $filename, 'public');
            $path = $file->move(public_path('uploads'), $filename);
            
            sleep(5); // Espera 5 segundos para asegurarse de que el archivo se haya guardado correctamente

            $file = str_replace('\\', '/', public_path('uploads/' . $filename));
            //$file = str_replace('\\', '/', $path);
            //Log::error('Error al importar CSV: ' . $path);
            //Log::error('File: ' . $file);
            
            try {
                $sql = <<<END
                            load data local infile '%s' ignore
                            into table `registrosfuid`
                            character set utf8
                            fields terminated by ';'
                            OPTIONALLY ENCLOSED BY '\\"'
                            lines terminated by '\\r\\n'
                            ignore 1 lines
                            (id_cabecerafuid, orden, id_serie, id_subserie, unidad_documental, fecha_inicial, fecha_final, soporte_fisico, soporte_electronico, caja, carpeta, tomolegajolibro, folios, codigobarrascaja, codigobarrascarpeta, signatura_topografica, otro_tipo, otro_cantidad, electronico_ubicacion, electronico_cantidad, electronico_tamano, notas);
                            END;

                $response = DB::affectingStatement(sprintf($sql, $file));
                if ($response === false) {
                    $errorInfo = DB::connection()->getpdo()->errorInfo();
                    return back()->with('error', 'Error al importar CSV: ' . $errorInfo[2]);
                } else {
                    return back()->with('success', 'CSV importado exitosamente! Filas afectadas: ' . $response);
                }
            } catch (Exception $e) {
                Log::error('Error al importar CSV: ' . $e->getMessage());

                return response()->json(['error' => 'Error al importar CSV'], 404);
            }
        } else {
            return back()->with('error', 'No se ha seleccionado ningún archivo CSV.');
        }
    }
}
