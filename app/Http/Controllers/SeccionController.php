<?php

namespace App\Http\Controllers;

use App\Models\Seccion;
use App\Models\tiposeccion;
use App\Models\Subseccion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SeccionRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $secciones = Seccion::paginate();

        return view('seccion.index', compact('secciones'))
            ->with('i', ($request->input('page', 1) - 1) * $secciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $secciones = new Seccion();
        $tiposeccion = tiposeccion::pluck('nombre', 'id');

        return view('seccion.create', compact('secciones', 'tiposeccion'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SeccionRequest $request): RedirectResponse
    {
        Seccion::create($request->validated());

        return Redirect::route('seccion.index')
            ->with('success', 'Seccion created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $i = 0;
        $secciones = Seccion::find($id);
        $tiposeccion = tiposeccion::pluck('nombre', 'id');
        $subsecciones = Subseccion::where('id_seccion', $id)->get();

        return view('seccion.show', compact('secciones', 'tiposeccion', 'subsecciones', 'i'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $secciones = Seccion::find($id);
        $tiposeccion = tiposeccion::pluck('nombre', 'id');

        return view('seccion.edit', compact('secciones', 'tiposeccion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SeccionRequest $request, Seccion $seccion): RedirectResponse
    {
        $seccion->update($request->validated());

        return Redirect::route('seccion.index')
            ->with('success', 'Seccion updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Seccion::find($id)->delete();

        return Redirect::route('seccion.index')
            ->with('success', 'Seccion deleted successfully');
    }
}
