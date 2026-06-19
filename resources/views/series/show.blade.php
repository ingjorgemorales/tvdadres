@extends('layouts.app')

@section('template_title')
    {{ $series->name ?? __('Show') . " " . __('Series') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title" style="font-size: 1.25rem; font-weight: bold;">Ver Serie</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('series.index') }}"> << Atrás</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Codigo:</strong>
                                    {{ $series->codigo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre:</strong>
                                    {{ $series->nombre }}
                                </div>

                    </div>

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="subseriesTable">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
									    <th>Código Subsrie</th>
									    <th>Subserie</th>
                                        <th>Código Serie</th>
                                        <th>Serie</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subseries as $subseriess)
                                        <tr>
                                            <td>{{ ++$i }}</td>    
                                            <td >{{ $subseriess->codigo }}</td>
                                            <td >{{ $subseriess->nombre }}</td>
                                            <td >{{ $subseriess->series->codigo }}</td>
                                            <td >{{ $subseriess->series->nombre }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
