@extends('layouts.app')

@section('template_title')
    {{ $registrosfuid->name ?? __('Show') . " " . __('Registrosfuid') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title" style="font-weight: bold; font-size: 1.25rem;">Ver Registro de Formato Único de Inventario Documental</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('cabecerafuid.index') }}"> << Atrás</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <!--<div class="form-group mb-2 mb20">
                                    <strong>Id Cabecerafuid:</strong>
                                    {{ $registrosfuid->id_cabecerafuid }}
                                </div>-->
                                <div class="form-group mb-2 mb20">
                                    <strong>Orden:</strong>
                                    {{ $registrosfuid->orden }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Serie:</strong>
                                    {{ $registrosfuid->series->nombre ?? '' }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Subserie:</strong>
                                    {{ $registrosfuid->subseries->nombre ?? '' }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Unidad Documental:</strong>
                                    {{ $registrosfuid->unidad_documental }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Inicial:</strong>
                                    {{ date('d/m/Y', strtotime($registrosfuid->fecha_inicial)) }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Final:</strong>
                                    {{ date('d/m/Y', strtotime($registrosfuid->fecha_final)) }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Soporte Fisico:</strong>
                                    {{ $registrosfuid->soporte_fisico }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Soporte Electronico:</strong>
                                    {{ $registrosfuid->soporte_electronico }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Caja:</strong>
                                    {{ $registrosfuid->caja }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Carpeta:</strong>
                                    {{ $registrosfuid->carpeta }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Tomolegajolibro:</strong>
                                    {{ $registrosfuid->tomolegajolibro }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Folios:</strong>
                                    {{ $registrosfuid->folios }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Codigibarrascaja:</strong>
                                    {{ $registrosfuid->codigibarrascaja }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Codigibarrascarpeta:</strong>
                                    {{ $registrosfuid->codigibarrascarpeta }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Signatura Topografica:</strong>
                                    {{ $registrosfuid->signatura_topografica }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Otro Tipo:</strong>
                                    {{ $registrosfuid->otro_tipo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Otro Cantidad:</strong>
                                    {{ $registrosfuid->otro_cantidad }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Electronico Ubicacion:</strong>
                                    {{ $registrosfuid->electronico_ubicacion }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Electronico Cantidad:</strong>
                                    {{ $registrosfuid->electronico_cantidad }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Electronico Tamano:</strong>
                                    {{ $registrosfuid->electronico_tamano }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Notas:</strong>
                                    {{ $registrosfuid->notas }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
