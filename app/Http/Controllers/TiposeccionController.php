<?php

namespace App\Http\Controllers;

use App\Models\Tiposeccion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TiposeccionRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TiposeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $tiposecciones = Tiposeccion::paginate();

        return view('tiposeccion.index', compact('tiposecciones'))
            ->with('i', ($request->input('page', 1) - 1) * $tiposecciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $tiposeccion = new Tiposeccion();

        return view('tiposeccion.create', compact('tiposeccion'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TiposeccionRequest $request): RedirectResponse
    {
        Tiposeccion::create($request->validated());

        return Redirect::route('tiposeccion.index')
            ->with('success', 'Tiposeccion created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $tiposeccion = Tiposeccion::find($id);

        return view('tiposeccion.show', compact('tiposeccion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $tiposeccion = Tiposeccion::find($id);

        return view('tiposeccion.edit', compact('tiposeccion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TiposeccionRequest $request, Tiposeccion $tiposeccion): RedirectResponse
    {
        $tiposeccion->update($request->validated());

        return Redirect::route('tiposeccion.index')
            ->with('success', 'Tiposeccion updated successfully');
    }


    public function destroy($id): RedirectResponse
    {
        Tiposeccion::find($id)->delete();

        return Redirect::route('tiposeccion.index')
            ->with('success', 'Tiposeccion deleted successfully');
    }
}
