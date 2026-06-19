@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Cabecerafuid
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">Actualizar Formato Único de Inventario Documental</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('cabecerafuid.index') }}"> << Atrás</a>
                        </div>
                    </div>
                </div>

                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('cabecerafuid.update', $cabecerafuid->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('cabecerafuid.form')

                        </form>
                    </div>
            </div>
        </div>
    </section>
@endsection
