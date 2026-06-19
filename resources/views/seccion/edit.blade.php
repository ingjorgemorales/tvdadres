@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Seccion
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">Editar Sección</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('seccion.index') }}"> << Atrás</a>
                        </div>
                    </div>
                    
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('seccion.update', $secciones->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('seccion.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
