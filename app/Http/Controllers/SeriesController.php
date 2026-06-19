<?php

namespace App\Http\Controllers;

use App\Models\Series;
use App\Models\Subseries;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $series = Series::paginate();

        return view('series.index', compact('series'))
            ->with('i', ($request->input('page', 1) - 1) * $series->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $series = new Series();

        return view('series.create', compact('series'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SeriesRequest $request): RedirectResponse
    {
        Series::create($request->validated());

        return Redirect::route('series.index')
            ->with('success', 'Series created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {   
        $i = 0;
        $series = Series::find($id);
        $subseries = Subseries::where('id_serie', $id)->get();

        return view('series.show', compact('series', 'subseries', 'i'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $series = Series::find($id);

        return view('series.edit', compact('series'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SeriesRequest $request, Series $series): RedirectResponse
    {
        $series->update($request->validated());

        return Redirect::route('series.index')
            ->with('success', 'Series updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Series::find($id)->delete();

        return Redirect::route('series.index')
            ->with('success', 'Series deleted successfully');
    }
}
