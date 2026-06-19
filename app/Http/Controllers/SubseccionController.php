<?php

namespace App\Http\Controllers;

use App\Models\Subseccion;
use App\Models\Seccion;
use App\Models\Tiposeccion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SubseccionRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SubseccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $subsecciones = Subseccion::paginate();

        return view('subseccion.index', compact('subsecciones'))
            ->with('i', ($request->input('page', 1) - 1) * $subsecciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $subsecciones = new Subseccion();
        $secciones = Seccion::pluck('nombre', 'id');
        $tiposeccion = tiposeccion::pluck('nombre', 'id');

        return view('subseccion.create', compact('subsecciones', 'secciones', 'tiposeccion'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubseccionRequest $request): RedirectResponse
    {
        Subseccion::create($request->validated());

        return Redirect::route('subseccion.index')
            ->with('success', 'Subseccion created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $subsecciones = Subseccion::find($id);
        $secciones = Seccion::pluck('nombre', 'id');
        $tiposeccion = tiposeccion::pluck('nombre', 'id');

        return view('subseccion.show', compact('subsecciones', 'secciones', 'tiposeccion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $subsecciones = Subseccion::find($id);
        $secciones = Seccion::pluck('nombre', 'id');
        $tiposeccion = tiposeccion::pluck('nombre', 'id');

        return view('subseccion.edit', compact('subsecciones', 'secciones', 'tiposeccion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubseccionRequest $request, Subseccion $subseccion): RedirectResponse
    {
        $subseccion->update($request->validated());

        return Redirect::route('subseccion.index')
            ->with('success', 'Subseccion updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Subseccion::find($id)->delete();

        return Redirect::route('subseccion.index')
            ->with('success', 'Subseccion deleted successfully');
    }
}
