@extends('layouts.app')

@section('template_title')
    {{ $matriztvd->name ?? __('Show') . " " . __('Matriztvd') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title" style="font-size: 1.25rem; font-weight: bold;">Ver Matriz TVD</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('matriztvd.index') }}"> {{ __('<< Atrás') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Código Sección:</strong>
                                    {{ $matriztvds->seccion->codigo ?? 'N/A' }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre Sección:</strong>
                                    {{ $matriztvds->seccion->nombre ?? 'N/A' }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Código Subsección:</strong>
                                    {{ $matriztvds->subseccion->codigo ?? 'N/A' }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre Subsección:</strong>
                                    {{ $matriztvds->subseccion->nombre ?? 'N/A' }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Código Serie:</strong>
                                    {{ $matriztvds->series->codigo ?? 'N/A' }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre Serie:</strong>
                                    {{ $matriztvds->series->nombre ?? 'N/A' }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Código Suberie:</strong>
                                    {{ $matriztvds->subseries->codigo ?? 'N/A' }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Subserie:</strong>
                                    {{ $matriztvds->subseries->nombre ?? 'N/A' }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
