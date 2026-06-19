<?php

namespace App\Http\Controllers;

use App\Models\Registrosfuid;
use App\Models\Series;
use App\Models\Subseries;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\RegistrosfuidRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class RegistrosfuidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $registrosfuid = Registrosfuid::paginate();
        $series = Series::pluck('nombre', 'id');
        $subseries = Subseries::pluck('nombre', 'id');

        return view('registrosfuid.index', compact('registrosfuid', 'series', 'subseries'))
            ->with('i', ($request->input('page', 1) - 1) * $registrosfuid->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $registrosfuid = new Registrosfuid();
        $series = Series::pluck('nombre', 'id');
        $subseries = Subseries::pluck('nombre', 'id');

        return view('registrosfuid.create', compact('registrosfuid', 'series', 'subseries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegistrosfuidRequest $request): RedirectResponse
    {
        Registrosfuid::create($request->validated());

        return Redirect::route('registrosfuid.index')
            ->with('success', 'Registrosfuid created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $registrosfuid = Registrosfuid::find($id);
        $series = Series::pluck('nombre', 'id');
        $subseries = Subseries::pluck('nombre', 'id');

        return view('registrosfuid.show', compact('registrosfuid', 'series', 'subseries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $registrosfuid = Registrosfuid::find($id);
        $series = Series::pluck('nombre', 'id');
        $subseries = Subseries::pluck('nombre', 'id');

        return view('registrosfuid.edit', compact('registrosfuid', 'series', 'subseries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RegistrosfuidRequest $request, Registrosfuid $registrosfuid): RedirectResponse
    {
        $registrosfuid->update($request->validated());

        return Redirect::route('registrosfuid.index')
            ->with('success', 'Registrosfuid updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Registrosfuid::find($id)->delete();

        return Redirect::route('registrosfuid.index')
            ->with('success', 'Registrosfuid deleted successfully');
    }
}
