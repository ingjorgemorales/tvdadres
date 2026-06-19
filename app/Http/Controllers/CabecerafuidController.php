<?php

namespace App\Http\Controllers;

use App\Models\Cabecerafuid;
use App\Models\Periodo;
use App\Models\Seccion;
use App\Models\Subseccion;
use App\Models\Series;
use App\Models\Subseries;
use App\Models\Registrosfuid;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CabecerafuidRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CabecerafuidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $i = 0;
        $cabecerafuids = Cabecerafuid::paginate(20);
        $seccion = Seccion::pluck('nombre', 'id');
        $subseccion = Subseccion::pluck('nombre', 'id');
        $periodo = Periodo::pluck('nombre', 'id');
        $series = Series::pluck('nombre', 'id');
        $subseries = Subseries::pluck('nombre', 'id');
        //$registrosfuids = Registrosfuid::with('seccion', 'subseccion', 'series', 'subseries')->get();

        return view('cabecerafuid.index', compact('cabecerafuids', 'seccion', 'subseccion', 'periodo', 'series', 'subseries', 'i'))
            ->with('i', ($request->input('page', 1) - 1) * $cabecerafuids->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $cabecerafuid = new Cabecerafuid();
        $seccion = Seccion::pluck('nombre', 'id');
        $subseccion = Subseccion::pluck('nombre', 'id');
        $periodo = Periodo::pluck('nombre', 'id');
        $serie = Series::pluck('nombre', 'id');
        $subserie = Subseries::pluck('nombre', 'id');

        return view('cabecerafuid.create', compact('cabecerafuid', 'seccion', 'subseccion', 'periodo', 'serie', 'subserie'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CabecerafuidRequest $request): RedirectResponse
    {
        Cabecerafuid::create($request->validated());

        return Redirect::route('cabecerafuid.index')
            ->with('success', 'Cabecerafuid created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $i = 0;
        $cabecerafuid = Cabecerafuid::find($id);
        $seccion = Seccion::pluck('nombre', 'id');
        $subseccion = Subseccion::pluck('nombre', 'id');
        $periodo = Periodo::pluck('nombre', 'id');
        $series = Series::pluck('nombre', 'id');
        $subserie = Subseries::pluck('nombre', 'id');
        //$registrosfuid = Registrosfuid::with('seccion', 'subseccion', 'series', 'subseries')->get()->where('id_cabecerafuid', $id);
        //$registrosfuids = Registrosfuid::paginate(50, ['*'], 'registrosfuid', $id, 100)->where('id_cabecerafuid', $id);
        $registrosfuids = Registrosfuid::select('registrosfuid.*')
            ->leftjoin('series', 'registrosfuid.id_serie', '=', 'series.id')
            ->leftjoin('subseries', 'registrosfuid.id_subserie', '=', 'subseries.id')
            ->addSelect([
                'series.nombre as nombre_serie',
                'subseries.nombre as nombre_subserie'
            ])
            ->where('id_cabecerafuid', $id)
            ->orderBy('registrosfuid.id', 'asc')
            ->cursorPaginate(1000);

        return view('cabecerafuid.show', compact('cabecerafuid', 'registrosfuids', 'series', 'subserie', 'periodo', 'seccion', 'subseccion', 'i'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $cabecerafuid = Cabecerafuid::find($id);
        //$registrosfuids = Registrosfuid::with('series', 'subseries')->where('id_cabecerafuid', $id)->get();
        $seccion = Seccion::pluck('nombre', 'id');
        $subseccion = Subseccion::pluck('nombre', 'id');
        $periodo = Periodo::pluck('nombre', 'id');
        $serie = Series::pluck('nombre', 'id');
        $subserie = Subseries::pluck('nombre', 'id');

        return view('cabecerafuid.edit', compact('cabecerafuid', 'seccion', 'subseccion', 'periodo', 'serie', 'subserie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CabecerafuidRequest $request, Cabecerafuid $cabecerafuid): RedirectResponse
    {
        $cabecerafuid->update($request->validated());

        return Redirect::route('cabecerafuid.index')
            ->with('success', 'Cabecerafuid updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Cabecerafuid::find($id)->delete();

        return Redirect::route('cabecerafuid.index')
            ->with('success', 'Cabecerafuid deleted successfully');
    }
}
