<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CarpetaController extends Controller
{
    public function index() {
        
        //$path = public_path('Jhon Fredy Zabala');
        //$archivos = Storage::disk('local')->files('Jhon Fredy Zabala');

        $usuario = auth()->user(); 
        $usuario = Auth::user(); 
        $nombre = auth()->user()->name;
        $correo = auth()->user()->email;

        if (!File::exists(public_path($nombre))) {
            File::makeDirectory(public_path($nombre), 0755, true);
        }

        $directory = public_path($nombre);
        $url = url()->to('/') . '/public/' . $nombre . '/';
        $archivos = File::allFiles($directory);

        return view('carpetas.carpeta', compact('archivos', 'nombre', 'correo', 'url'));
    }
}
