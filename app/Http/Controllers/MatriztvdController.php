<?php

namespace App\Http\Controllers;

use App\Models\Matriztvd;
use App\Models\Seccion;
use App\Models\Subseccion;
use App\Models\Series;
use App\Models\Subseries;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MatriztvdRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MatriztvdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $i = 0;
        $matriztvds = Matriztvd::all();
        $secciones = Seccion::pluck('nombre', 'id');
        $subsecciones = Subseccion::pluck('nombre', 'id');
        $series = Series::pluck('nombre', 'id');
        $subseries = Subseries::pluck('nombre', 'id');

        return view('matriztvd.index', compact('matriztvds', 'secciones', 'subsecciones', 'series', 'subseries', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $matriztvds = new Matriztvd();
        $secciones = Seccion::pluck('nombre', 'id');
        $subsecciones = Subseccion::pluck('nombre', 'id');
        $series = Series::pluck('nombre', 'id');
        $subseries = Subseries::pluck('nombre', 'id');

        return view('matriztvd.create', compact('matriztvds', 'secciones', 'subsecciones', 'series', 'subseries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MatriztvdRequest $request): RedirectResponse
    {
        Matriztvd::create($request->validated());

        return Redirect::route('matriztvd.index')
            ->with('success', 'Matriztvd created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $matriztvds = Matriztvd::find($id);
        $secciones = Seccion::pluck('nombre', 'id');
        $subsecciones = Subseccion::pluck('nombre', 'id');
        $series = Series::pluck('nombre', 'id');
        $subseries = Subseries::pluck('nombre', 'id');

        return view('matriztvd.show', compact('matriztvds', 'secciones', 'subsecciones', 'series', 'subseries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $matriztvds = Matriztvd::find($id);
        $secciones = Seccion::pluck('nombre', 'id');
        $subsecciones = Subseccion::pluck('nombre', 'id');
        $series = Series::pluck('nombre', 'id');
        $subseries = Subseries::pluck('nombre', 'id');

        return view('matriztvd.edit', compact('matriztvds', 'secciones', 'subsecciones', 'series', 'subseries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MatriztvdRequest $request, Matriztvd $matriztvd): RedirectResponse
    {
        $matriztvd->update($request->validated());

        return Redirect::route('matriztvd.index')
            ->with('success', 'Matriztvd updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Matriztvd::find($id)->delete();

        return Redirect::route('matriztvd.index')
            ->with('success', 'Matriztvd deleted successfully');
    }
}
