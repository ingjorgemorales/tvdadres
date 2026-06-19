@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Cabeceraccd
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title" style="font-weight: bold; font-size: 1.5rem;">Modificar Cuadro de Clasificación Documental</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('cabeceraccd.index') }}"> {{ __('<< Atrás') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('cabeceraccd.update', $cabeceraccd->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('cabeceraccd.form')

                        </form>
                    </div>
                
            </div>
        </div>
    </section>
@endsection
