<?php

namespace App\Http\Controllers;

use App\Models\Cabeceraccd;
use App\Models\Periodo;
use App\Models\Registrosccd;
use App\Models\Seccion;
use App\Models\Subseccion;
use App\Models\Series;
use App\Models\Subseries;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CabeceraccdRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CabeceraccdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $i = 0;
        $cabeceraccd = Cabeceraccd::paginate();
        $registrosccds = Registrosccd::with('seccion', 'subseccion', 'series', 'subseries')->get();
        $periodos = Periodo::pluck('nombre', 'id');
        $seccion = Seccion::pluck('nombre', 'id');
        $subseccion = Subseccion::pluck('nombre', 'id');
        $serie = Series::pluck('nombre', 'id');
        $subserie = Subseries::pluck('nombre', 'id');

        return view('cabeceraccd.index', compact('cabeceraccd', 'registrosccds', 'periodos', 'seccion', 'subseccion', 'serie', 'subserie', 'i'))
            ->with('i', ($request->input('page', 1) - 1) * $cabeceraccd->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $i = 1;
        $cabeceraccd = new Cabeceraccd();
        $periodos = Periodo::pluck('nombre', 'id');
        $registrosccds = Registrosccd::with('seccion', 'subseccion', 'series', 'subseries')->get();
        $seccion = Seccion::pluck('nombre', 'id');
        $subseccion = Subseccion::pluck('nombre', 'id');
        $serie = Series::pluck('nombre', 'id');
        $subserie = Subseries::pluck('nombre', 'id');

        return view('cabeceraccd.create', compact('cabeceraccd', 'periodos', 'registrosccds', 'seccion', 'subseccion', 'serie', 'subserie', 'i' ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CabeceraccdRequest $request): RedirectResponse
    {
        Cabeceraccd::create($request->validated());

        return Redirect::route('cabeceraccd.index')
            ->with('success', 'Cabeceraccd created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $i = 1;
        $cabeceraccd = Cabeceraccd::find($id);
        $periodos = Periodo::pluck('nombre', 'id');
        $registrosccds = Registrosccd::with('seccion', 'subseccion', 'series', 'subseries')->get()->where('id_cabeceraccd', $id);
        $seccion = Seccion::pluck('nombre', 'id');
        $subseccion = Subseccion::pluck('nombre', 'id');
        $serie = Series::pluck('nombre', 'id');
        $subserie = Subseries::pluck('nombre', 'id');

        return view('cabeceraccd.show', compact('cabeceraccd', 'periodos', 'registrosccds', 'seccion', 'subseccion', 'serie', 'subserie', 'i'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $i = 1;
        $cabeceraccd = Cabeceraccd::find($id);
        $periodos = Periodo::pluck('nombre', 'id');
        $registrosccds = Registrosccd::with('seccion', 'subseccion', 'series', 'subseries')->get();
        $seccion = Seccion::pluck('nombre', 'id');
        $subseccion = Subseccion::pluck('nombre', 'id');
        $serie = Series::pluck('nombre', 'id');
        $subserie = Subseries::pluck('nombre', 'id');

        return view('cabeceraccd.edit', compact('cabeceraccd', 'periodos', 'registrosccds', 'seccion', 'subseccion', 'serie', 'subserie', 'i'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CabeceraccdRequest $request, Cabeceraccd $cabeceraccd): RedirectResponse
    {
        $cabeceraccd->update($request->validated());

        return Redirect::route('cabeceraccd.index')
            ->with('success', 'Cabeceraccd updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Cabeceraccd::find($id)->delete();

        return Redirect::route('cabeceraccd.index')
            ->with('success', 'Cabeceraccd deleted successfully');
    }
}
