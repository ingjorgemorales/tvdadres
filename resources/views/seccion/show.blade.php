@extends('layouts.app')

@section('template_title')
    {{ $secciones->name ?? __('Show') . " " . __('Seccion') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title" style="font-weight: bold; font-size: 1.25rem;">Ver Sección</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('seccion.index') }}">
                                << Atrás</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">

                        <div class="form-group mb-2 mb20">
                            <strong>Código:</strong>
                            {{ $secciones->codigo }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Nombre:</strong>
                            {{ $secciones->nombre }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Tipo Sección:</strong>
                            @foreach($tiposeccion as $id => $nombre)
                                {{ old('id_tipo', $secciones?->id_tipo) == $id ? $nombre : '' }}
                            @endforeach
                        </div>

                    </div>
                </div>
                </br>
                <div class="float-left">
                    <span class="card-title" style="font-weight: bold; font-size: 1.25rem; display: flex; justify-content: space-between; align-items: center;">
                        <strong>Subsecciones</strong>
                    </span>
                </div>
                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="subseccionTable">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>Sección</th>
                                    <th>Código Subsección</th>
                                    <th>Nombre Subsección</th>
                                    <th>Tipo Sección</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subsecciones as $subseccion)
                                    <tr>
                                        <td>{{ ++$i }}</td>

                                        <td>{{ $subseccion->seccion->nombre }}</td>
                                        <td>{{ $subseccion->codigo }}</td>
                                        <td>{{ $subseccion->nombre }}</td>
                                        <td>{{ $subseccion->tiposeccion->nombre }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
