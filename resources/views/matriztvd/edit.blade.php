@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Matriztvd
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title" style="font-size: 1.25rem; font-weight: bold;">Actualizar Registro Matriz</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('matriztvd.index') }}"> {{ __('<< Atrás') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('matriztvd.update', $matriztvds->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('matriztvd.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
