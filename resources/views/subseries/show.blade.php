@extends('layouts.app')

@section('template_title')
    {{ $subseries->name ?? __('Show') . " " . __('Subseries') }}
@endsection

@section('content')
        <section class="content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="float-left">
                                <span class="card-title" style="font-size: 1.25rem; font-weight: bold;">Ver Subserie</span>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-primary btn-sm" href="{{ route('subseries.index') }}"> << Atrás</a>
                            </div>
                        </div>
                        <div class="card-body bg-white">

                            <div class="form-group mb-2 mb20">
                                <strong>Código Subserie:</strong>
                                {{ $subseries->codigo }}
                            </div>
                            <div class="form-group mb-2 mb20">
                                <strong>Nombre Subserie:</strong>
                                {{ $subseries->nombre }}
                            </div>
                            <div class="form-group mb-2 mb20">
                                <strong>Código Serie:</strong>
                                {{ $subseries->series->codigo }}
                            </div>
                            <div class="form-group mb-2 mb20">
                                <strong>Nombre Serie:</strong>
                                @foreach($series as $id => $nombre)
                                    {{ old('id_serie', $subseries?->id_serie) == $id ? $nombre : '' }}
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
