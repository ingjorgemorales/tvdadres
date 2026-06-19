<?php

namespace App\Http\Controllers;

use App\Models\Registrosccd;
use App\Models\Seccion;
use App\Models\Subseccion;
use App\Models\Series;
use App\Models\Subseries;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\RegistrosccdRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class RegistrosccdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $i = 1;
        $registrosccds = Registrosccd::with('seccion', 'subseccion', 'series', 'subseries')->get();
        $seccion = Seccion::pluck('nombre', 'id');
        $subseccion = Subseccion::pluck('nombre', 'id');
        $serie = Series::pluck('nombre', 'id');
        $subserie = Subseries::pluck('nombre', 'id');

        return view('registrosccd.index', compact('registrosccds', 'seccion', 'subseccion', 'serie', 'subserie', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $registrosccd = new Registrosccd();
        $seccion = Seccion::pluck('nombre', 'id');
        $subseccion = Subseccion::pluck('nombre', 'id');
        $serie = Series::pluck('nombre', 'id');
        $subserie = Subseries::pluck('nombre', 'id');

        return view('registrosccd.create', compact('registrosccd', 'seccion', 'subseccion', 'serie', 'subserie'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegistrosccdRequest $request): RedirectResponse
    {
        Registrosccd::create($request->validated());

        return Redirect::route('registrosccd.index')
            ->with('success', 'Registrosccd created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $registrosccd = Registrosccd::find($id);
        $seccion = Seccion::pluck('nombre', 'id');
        $subseccion = Subseccion::pluck('nombre', 'id');
        $serie = Series::pluck('nombre', 'id');
        $subserie = Subseries::pluck('nombre', 'id');

        return view('registrosccd.show', compact('registrosccd', 'seccion', 'subseccion', 'serie', 'subserie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $registrosccd = Registrosccd::find($id);
        $seccion = Seccion::pluck('nombre', 'id');
        $subseccion = Subseccion::pluck('nombre', 'id');
        $serie = Series::pluck('nombre', 'id');
        $subserie = Subseries::pluck('nombre', 'id');

        return view('registrosccd.edit', compact('registrosccd', 'seccion', 'subseccion', 'serie', 'subserie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RegistrosccdRequest $request, Registrosccd $registrosccd): RedirectResponse
    {
        $registrosccd->update($request->validated());

        return Redirect::route('registrosccd.index')
            ->with('success', 'Registrosccd updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Registrosccd::find($id)->delete();

        return Redirect::route('registrosccd.index')
            ->with('success', 'Registrosccd deleted successfully');
    }
}
