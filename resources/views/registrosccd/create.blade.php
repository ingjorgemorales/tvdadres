@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Registrosccd
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left" style="font-weight: bold">
                            <span class="card-title" style="font-weight: bold; font-size: 1.5rem;">Crear Registros CCD</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('cabeceraccd.index') }}"> << Atrás</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('registrosccd.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('registrosccd.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
