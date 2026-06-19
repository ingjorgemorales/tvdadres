<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">

    <title>{{ config('app.name', 'Inventarios') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/2.3.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.8/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.8/js/buttons.datatables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.8/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.8/js/buttons.print.min.js"></script>

    <script>
        let inactivityTime = function () {
            let time;
            function logout() {
                window.location.href = "{{ route('login') }}"; 
            }
            function resetTimer() {
                clearTimeout(time);
                time = setTimeout(logout, 600000); 
            }
            window.addEventListener('load', resetTimer);
            document.addEventListener('mousemove', resetTimer);
            document.addEventListener('keypress', resetTimer);
            document.addEventListener('scroll', resetTimer);
            document.addEventListener('click', resetTimer);
        };
        inactivityTime();
    </script>
    @yield('js')
</head>
<body @if (auth()->check()) style="background-color: #f3f4f6; min-height: 100vh;" @endif style="background-image: url('img/Fondo.png'); background-size: cover; background-attachment: fixed;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
            <div class="container">
                <div class="container-logo">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="navbar-brand" style="height: 60px;">
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        @if (auth()->check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProcesos" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: rgb(5, 8, 148); font-size: large;">
                                Procesos
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownProcesos">
                                @can('ViewAny:Cabeceraccd')
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('cabeceraccd.index') }}">Cuadros Clasificación Documental</a>
                                </li>
                                @endcan
                                @can('ViewAny:Cabecerafuid')
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('cabecerafuid.index') }}">Formato Ünico de Inventario Documental</a>
                                </li>
                                @endcan
                                <li><hr class="dropdown-divider"></li>
                                @can('ViewAny:Consulta')
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('consulta.index') }}">Consultas Cuadros Clasificación Documental</a>
                                </li>
                                @endcan
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('consultaFuid.index') }}">Consultas FUID</a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('importccd.index') }}">Importar CCD</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('importfuid.index') }}">Importar FUID</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownArchivos" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: rgb(5, 8, 148); font-size: large;">
                                Archivos
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownArchivos">
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('carpeta.index') }}">Listado de Archivos Generados</a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @if (auth()->check() && auth()->user()->hasRole('super_admin'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAdmin" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: rgb(5, 8, 148); font-size: large;">
                                Administración
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownAdmin">
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('tiposeccion.index') }}">Tipo sección</a>
                                </li>
                                @can('ViewAny:Seccion')
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('seccion.index') }}">Sección</a>
                                </li>
                                @endcan
                                @can('ViewAny:Subseccion')
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('subseccion.index') }}">Subsección</a>
                                </li>
                                @endcan
                                @can('ViewAny:Series')
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('series.index') }}">Series</a>
                                </li>
                                @endcan
                                @can('ViewAny:Subseries')
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('subseries.index') }}">Subseries</a>
                                </li>
                                @endcan
                                @can('ViewAny:Matriztvd')
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('matriztvd.index') }}">Matriz TVD</a>
                                </li>
                                @endcan
                                @can('ViewAny:Periodo')
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('periodos.index') }}">Periodos</a>
                                </li>
                                @endcan
                                <li><hr class="dropdown-divider"></li>
                                @can('ViewAny:User')
                                <li><a class="dropdown-item" href="/admin" target="_blanck">Usuarios</a></li>
                                @endcan
                            </ul>
                        </li>
                        @endif
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdownUser" style="color: rgb(5, 8, 148); font-size: large;" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownUser">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Cerrar Sesión
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
