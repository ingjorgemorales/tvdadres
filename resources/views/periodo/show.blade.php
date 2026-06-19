@extends('layouts.app')

@section('template_title')
    {{ $periodo->name ?? __('Show') . " " . __('Periodo') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">Ver Periodo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('periodos.index') }}"> << Atrás</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="form-group mb-2 mb20">
                            <strong>Nombre:</strong>
                            {{ $periodo->nombre }}
                            </div> <div class="form-group mb-2 mb20">
                            <strong>Fecha Inicial:</strong>
                            {{ $periodo->fecha_inicial->format('Y-m-d') }}
                            </div> <div class="form-group mb-2 mb20">
                            <strong>Fecha Final:</strong>
                            {{ $periodo->fecha_final->format('Y-m-d') }}
                            </div> 
                        </div>
                    </div>
            </div>
        </div>
    </section>
@endsection
