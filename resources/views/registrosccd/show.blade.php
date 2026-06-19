@extends('layouts.app')

@section('template_title')
    {{ $registrosccd->name ?? __('Ver') . " " . __('Registrosccd') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left" style="font-weight: bold">
                            <span class="card-title" style="font-weight: bold; font-size: 1.5rem;">Ver Registro Cuadro Clasificación
                                Documental</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('cabeceraccd.index') }}"> {{ __('<< Atrás') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">

                        <div class="form-group mb-2 mb20">
                            <strong>Id:</strong>
                            {{ $registrosccd->id_cabeceraccd }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Acto Administrativo:</strong>
                            {{ $registrosccd->acto_administrativo }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Funcion:</strong>
                            {{ $registrosccd->funcion }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Código Sección:</strong>
                            {{ $registrosccd->seccion->codigo ?? '' }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Nombre Sección:</strong>
                            {{ $registrosccd->seccion->nombre ?? '' }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Código Subseccion:</strong>
                            {{ $registrosccd->subseccion->codigo ?? '' }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Nombre Subseccion:</strong>
                            {{ $registrosccd->subseccion->nombre ?? '' }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Código Serie:</strong>
                            {{ $registrosccd->series->codigo ?? '' }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Nombre Serie:</strong>
                            {{ $registrosccd->series->nombre ?? '' }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Código Subserie:</strong>
                            {{ $registrosccd->subseries->codigo ?? '' }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Nombre Subserie:</strong>
                            {{ $registrosccd->subseries->nombre ?? '' }}
                        </div>
                    </div>
                </div>
                </div>
        </div>
    </section>
@endsection
