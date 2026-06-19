@extends('layouts.app')

@section('content')
    <div class="container">
        <br></br>
        <br></br>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title" style="font-weight: bold">
                                Sistema de Inventarios Documentales - Iniciar Sesión
                            </span>

                            <div class="float-right">
                                <!--<a href="{{ route('register') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                    Registrar Usuario
                                </a>-->
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <br></br>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Correo electrónico</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div id="divpassword" class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>
                                <div class="col-md-6" style="display: flex; align-items: center;">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        <div class="form-check" style="margin-left: 10px;">
                                            <input class="form-check-input" type="checkbox" id="showPassword" onclick="handleClick(this)">
                                            <label class="form-check-label" for="showPassword">
                                                Mostrar
                                            </label>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            Recordar Contraseña
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Ingresar
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            ¿Ha olvidado su contraseña?
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('js')
        <script type="text/javascript">
            function handleClick(cb) {
            if(cb.checked)
                $('#password').attr("type","text");
            else
                $('#password').attr("type","password");
            }
        </script>
    @endsection
@endsection
