<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SeccionController;
use App\Http\Controllers\SubseccionController;
use App\Http\Controllers\TiposeccionController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SubseriesController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\MatriztvdController;
use App\Http\Controllers\CabeceraccdController;
use App\Http\Controllers\RegistrosccdController;
use App\Http\Controllers\CabecerafuidController;
use App\Http\Controllers\RegistrosfuidController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\ConsultaFuidController;
use App\Http\Controllers\ImportCCDController;
use App\Http\Controllers\ImportFuidController;
use App\Http\Controllers\CarpetaController;
use App\Models\Seccion;
use App\Models\Series;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::resource('/seccion', SeccionController::class)->middleware('auth');
Route::resource('/subseccion', SubseccionController::class)->middleware('auth');
Route::resource('/tiposeccion', TiposeccionController::class)->middleware('auth');
Route::resource('/series', SeriesController::class)->middleware('auth');
Route::resource('/subseries', SubseriesController::class)->middleware('auth');
Route::resource('/periodos', PeriodoController::class)->middleware('auth');

Route::resource('/matriztvd', MatriztvdController::class)->middleware('auth');

Route::resource('/cabeceraccd', CabeceraccdController::class)->middleware('auth');
Route::resource('/registrosccd', RegistrosccdController::class)->middleware('auth');
Route::resource('/cabecerafuid', CabecerafuidController::class)->middleware('auth');
Route::resource('/registrosfuid', RegistrosfuidController::class)->middleware('auth');

//Consulta
Route::get('/consulta', [ConsultaController::class, 'index'])->name('consulta.index')->middleware('auth');
Route::get('/secciones/{seccion}/subsecciones', function(Seccion $seccion) {
    $subsecciones = $seccion->subseccionesbyid;
    return response()->json($subsecciones);
});
Route::get('/series/{serie}/subseries', function(Series $serie) {
    $subseries = $serie->subseriesById;
    return response()->json($subseries);
});

Route::post('/consulta', [ConsultaController::class, 'store'])->name('consulta.store')->middleware('auth');
Route::post('/consulta/export', [ConsultaController::class, 'export'])->name('consulta.export')->middleware('auth');

//Consulta FUID
Route::get('/consultaFuid', [ConsultaFuidController::class, 'index'])->name('consultaFuid.index')->middleware('auth');

//Route::post('/consultaFuid', [ConsultaFuidController::class, 'store'])->name('consultaFuid.store');
Route::match(['get','post'], '/consultaFuid/export', [ConsultaFuidController::class, 'export'])->name('consultaFuid.export')->middleware('auth');
//Route::get('/consultaFuid/data', [ConsultaFuidController::class, 'getRegistros'])->name('consultaFuid.data');

Route::get('/importccd', [ImportCCDController::class, 'index'])->name('importccd.index')->middleware('auth');
Route::post('/importccd', [ImportCCDController::class, 'importcsv'])->name('importccd.importcsv')->middleware('auth');

Route::get('/importfuid', [ImportFuidController::class, 'index'])->name('importfuid.index')->middleware('auth');
Route::post('/importfuid', [ImportFuidController::class, 'importcsv'])->name('importfuid.importcsv')->middleware('auth');

Route::get('/carpeta', [CarpetaController::class, 'index'])->name('carpeta.index')->middleware('auth');

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

