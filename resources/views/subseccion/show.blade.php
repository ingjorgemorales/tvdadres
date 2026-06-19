@extends('layouts.app')

@section('template_title')
    {{ $subsecciones->name ?? __('Show') . " " . __('Subseccion') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title" style="font-size: 1.25rem; font-weight: bold;">Ver Subsección</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('subseccion.index') }}"> << Atrás</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">

                        <div class="form-group mb-2 mb20">
                            <strong>Sección:</strong>
                            {{ $subsecciones->id_seccion }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Código Subsección:</strong>
                            {{ $subsecciones->codigo }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Nombre Subsección:</strong>
                            {{ $subsecciones->nombre }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Tipo Sección:</strong>
                            @foreach($tiposeccion as $id => $nombre)
                                {{ old('id_tipo', $subsecciones?->id_tipo) == $id ? $nombre : '' }}
                            @endforeach
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Código Sección:</strong>
                            {{ $subsecciones->seccion->codigo }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Nombre Sección:</strong>
                            {{ $subsecciones->seccion->nombre }}
                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </section>
@endsection
