<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use app\Imports\CuadrosImport;
use Illuminate\Support\Facades\DB;

class ImportCCDController extends Controller
{
    public function index() {
        return view('Importar.ImportCCD');
    }

    public function store(Request $request) {
        // 1. Validación
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'message' => 'required|min:10',
        ]);

        // 2. Aquí guardarías en BD o enviarías un email
        // Mail::to('admin@ejemplo.com')->send(new ContactoMail($validated));

        // 3. Redireccionar con éxito
        return redirect()->route('importccd.index')->with('success', '¡Gracias! Tu consulta ha sido enviada.');
    }

    public function importcsv(Request $request) {

        $request->validate([
            'filecsv' => 'required|file|mimes:csv,txt',
        ]);

        $filename = $request->file('filecsv')->getClientOriginalName();
        $request->file('filecsv')->move(public_path('uploads'), $filename);
        $file = str_replace('\\', '/', public_path('uploads/RegistrosCCD.csv'));

        /*DB::unprepared("
            LOAD DATA LOCAL INFILE '$file'
            INTO TABLE registrosccd
            FIELDS TERMINATED BY ';'
            OPTIONALLY ENCLOSED BY '\"'
            LINES TERMINATED BY '\\n'
            IGNORE 1 LINES
            (id_cabeceraccd, acto_administrativo, funcion, id_seccion, id_subseccion, id_serie, id_subserie)
        ");
        */

        /*$query = sprintf("LOAD DATA local INFILE '%s' INTO TABLE `registrosccd` FIELDS TERMINATED BY ';'  ESCAPED BY '\"' LINES TERMINATED BY '\\n' IGNORE 1 LINES (
            `id_cabeceraccd`,
            `acto_administrativo`,
            `funcion`,
            `id_seccion`,
            `id_subseccion`,
            `id_serie`,
            `id_subserie`)", $file);

        $response = DB::connection()->getpdo()->exec($query);
        if ($response == '0') {
            $errorInfo = DB::connection()->getpdo()->errorInfo();
            return back()->with('error', 'Error al importar CSV: ' . $errorInfo[2]);
        } else {
            return back()->with('success', 'CSV importado exitosamente! Filas afectadas: ' . $response);
        }*/

            $sql = <<<END
                load data local infile '%s' ignore
                into table `registrosccd`
                character set utf8
                fields terminated by ';'
                OPTIONALLY ENCLOSED BY '\\"'
                lines terminated by '\\r\\n'
                ignore 1 lines
                (id_cabeceraccd, acto_administrativo, funcion, id_seccion, id_subseccion, id_serie, id_subserie);
                END;

            $response = DB::affectingStatement( sprintf( $sql, $file ) );
            if ($response === false) {
                $errorInfo = DB::connection()->getpdo()->errorInfo();
                return back()->with('error', 'Error al importar CSV: ' . $errorInfo[2]);
            } else {
                //$filasAfectadas = DB::getPdo()->exec("SELECT ROW_COUNT()");
                return back()->with('success', 'CSV importado exitosamente! Filas afectadas: ' . $response);
            }

        //turn back()->with('success', 'CSV imported successfully!');

        /*$path = $request->file('filecsv')->getRealPath();
        if (($handle = fopen($path, 'r')) !== false) {
            $header = fgetcsv($handle, 1000, ';'); // Optional: header row
            $batchSize = 500; // Insert in chunks
            $dataBatch = [];
            while (($row = fgetcsv($handle, 1000, ';')) !== false) {
                $dataBatch[] = [
                    'id_cabeceraccd' => $row[0],
                    'acto_administrativo' => $row[1],
                    'funcion' => $row[2],
                    'id_seccion' => $row[3],
                    'id_subseccion' => $row[4],
                    'id_serie' => $row[5],
                    'id_subserie' => $row[6],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                // When batch is full, insert into DB
                if (count($dataBatch) === $batchSize) {
                    DB::table('registrosccd')->insert($dataBatch);
                    $dataBatch = [];
                }
            }
            // Insert any remaining rows
            if (!empty($dataBatch)) {
                DB::table('registrosccd')->insert($dataBatch);
            }
            fclose($handle);
        }
        return back()->with('success', 'CSV imported successfully!');*/


        /*$filename = $request->file('filecsv')->getClientOriginalName();
        $request->file('filecsv')->move(public_path('uploads'), $filename);

        Excel::import(new CuadrosImport, public_path('uploads/CCD.csv'));
        
        return redirect()->route('importccd.index')->with('success', '¡Archivo importado exitosamente!');*/
        
    }

}
