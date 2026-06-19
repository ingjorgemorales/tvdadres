<?php

namespace App\Http\Controllers;

use App\Models\Subseries;
use App\Models\Series;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SubseriesRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SubseriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $subseries = Subseries::paginate();

        return view('subseries.index', compact('subseries'))
            ->with('i', ($request->input('page', 1) - 1) * $subseries->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $subseries = new Subseries();
        $series = Series::pluck('nombre', 'id');

        return view('subseries.create', compact('subseries', 'series'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubseriesRequest $request): RedirectResponse
    {
        Subseries::create($request->validated());

        return Redirect::route('subseries.index')
            ->with('success', 'Subseries created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $subseries = Subseries::find($id);
        $series = Series::pluck('nombre', 'id');

        return view('subseries.show', compact('subseries', 'series'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $subseries = Subseries::find($id);
        $series = Series::pluck('nombre', 'id');

        return view('subseries.edit', compact('subseries', 'series'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubseriesRequest $request, Subseries $subseries): RedirectResponse
    {
        $subseries->update($request->validated());

        return Redirect::route('subseries.index')
            ->with('success', 'Subseries updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Subseries::find($id)->delete();

        return Redirect::route('subseries.index')
            ->with('success', 'Subseries deleted successfully');
    }
}
