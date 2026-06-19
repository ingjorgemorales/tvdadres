@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Cabeceraccd
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title" style="font-weight: bold; font-size: 1.5rem;">Crear Cuadro de Clasificación Documental</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('cabeceraccd.index') }}"> << Atrás</a>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('cabeceraccd.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('cabeceraccd.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
