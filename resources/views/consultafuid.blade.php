@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.standalone.css')}}">
@endsection

@section('js')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
    <script src="{{asset('datePicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('datePicker/locales/bootstrap-datepicker.es.min.js')}}"></script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Consulta FUID</h3>
                    </div>
                    <div class="card-body">
                        {{-- Mensaje de éxito --}}
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(isset($success))
                            <div class="alert alert-success">{{ $success }}</div>
                        @endif
                        <form id="frConsulta" action="{{ route('consultaFuid.index') }}" method="GET">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="periodo" class="form-label">Periodo</label>
                                    <select name="periodo" id="periodo"
                                        class="form-control @error('periodo') is-invalid @enderror">
                                        <option value="">Seleccione un periodo</option>
                                        @foreach($periodos as $periodo)
                                            <option value="{{ $periodo->id }}" {{ request('periodo') == $periodo->id ? 'selected' : '' }}>{{ $periodo->nombre }}
                                                ({{ date('d/m/Y', strtotime($periodo->fecha_inicial)) }} -
                                                {{ date('d/m/Y', strtotime($periodo->fecha_final)) }})</option>
                                        @endforeach
                                    </select>
                                    @error('periodo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="seccion" class="form-label">Sección</label>
                                    <select name="seccion" id="seccion" onchange="loadSubsecciones(this)"
                                        class="form-control @error('seccion') is-invalid @enderror">
                                        <option value="">Seleccione una sección</option>
                                        @foreach($secciones as $seccion)
                                            <option value="{{ $seccion->id }}" {{ request('seccion') == $seccion->id ? 'selected' : '' }}>{{ $seccion->codigo }} - {{ $seccion->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('seccion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="subseccion" class="form-label">Subsección</label>
                                    <select name="subseccion" id="subseccion"
                                        class="form-control @error('subseccion') is-invalid @enderror">
                                        <option value="">Seleccione una subsección</option>
                                        @if(request('seccion'))
                                            @foreach($subsecciones as $itemSubseccion)
                                                <option value="{{ $itemSubseccion->id }}" {{ request('subseccion') == $itemSubseccion->id ? 'selected' : '' }}>
                                                    {{ $itemSubseccion->codigo }} - {{ $itemSubseccion->nombre }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('subseccion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <label for="fecha_inicial" class="form-label">Fecha Inicial</label>
                                    <input type="text" name="fecha_inicial" id="fecha_inicial"
                                        class="form-control datepicker"
                                        value="{{ request('fecha_inicial') ? request('fecha_inicial') : '' }}">
                                    @error('fecha_inicial')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label for="fecha_final" class="form-label">Fecha Final</label>
                                    <input type="text" name="fecha_final" id="fecha_final" class="form-control datepicker"
                                        value="{{ request('fecha_final') ? request('fecha_final') : '' }}">
                                    @error('fecha_final')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="serie" class="form-label">Serie</label>
                                    <select name="serie" id="serie" onchange="loadSubseries(this)"
                                        class="form-control @error('serie') is-invalid @enderror">
                                        <option value="">Seleccione una serie</option>
                                        @foreach($series as $serie)
                                            <option value="{{ $serie->id }}" {{ request('serie') == $serie->id ? 'selected' : '' }}>{{ $serie->codigo }} - {{ $serie->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('serie')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="subserie" class="form-label">Subserie</label>
                                    <select name="subserie" id="subserie"
                                        class="form-control @error('subserie') is-invalid @enderror">
                                        <option value="">Seleccione una subserie</option>
                                        @if(request('serie'))
                                            @foreach($subseries as $itemSubserie)
                                                <option value="{{ $itemSubserie->id }}" {{ request('subserie') == $itemSubserie->id ? 'selected' : '' }}>{{ $itemSubserie->codigo }} - {{ $itemSubserie->nombre }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('subserie')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="caja" class="form-label">Caja</label>
                                    <input type="text" name="caja" id="caja" class="form-control"
                                        value="{{ request('caja', $caja) }}">
                                    @error('caja')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="carpeta" class="form-label">Carpeta</label>
                                    <input type="text" name="carpeta" id="carpeta" class="form-control"
                                        value="{{ request('carpeta', $carpeta) }}">
                                    @error('carpeta')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12" style="text-align: center">
                                    @can('View:ConsultaFuid')
                                    <button name="accion" value="consultar" type="submit" class="btn btn-primary">Consultar</button>
                                     @isset($resultados)
                                    &nbsp;&nbsp;<button name="accion" value="exportar" type="submit" class="btn btn-primary">Exportar a Excel</button>
                                    @endisset
                                    @endcan
                                </div>
                            </div>

                            @if (flash()->message)
                                <div class="{{ flash()->class }}">
                                    {{ flash()->message }}
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
       <!-- <div class="mt-4 d-flex">
            <form id="exportForm" action="{{ route('consultaFuid.export') }}" method="GET">
                @csrf
                <input type="hidden" name="seccion" value="{{ request('seccion') }}">
                <input type="hidden" name="subseccion" value="{{ request('subseccion') }}">
                <input type="hidden" name="serie" value="{{ request('serie') }}">
                <input type="hidden" name="subserie" value="{{ request('subserie') }}">
                <input type="hidden" name="periodo" value="{{ request('periodo') }}">
                <input type="hidden" name="fecha_inicial" value="{{ request('fecha_inicial') }}">
                <input type="hidden" name="fecha_final" value="{{ request('fecha_final') }}">
                <input type="hidden" name="caja" value="{{ request('caja') }}">
                <input type="hidden" name="carpeta" value="{{ request('carpeta') }}">
            </form>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary">Exportar a Excel</button>
        </div> -->
    
    <div class="table-responsive">
        <table id="registrosTable"
            class="table table-striped table-hover table-bordered table-sm shadow-lg mt-4 dataTable_width_auto"
            style="width:100%">
            <thead class="thead bg-primary text-white">
                <tr>
                    <th>No</th>
                    <th>Serie</th>
                    <th>Subserie</th>
                    <th>Unidad Documental</th>
                    <th>Fecha Inicial</th>
                    <th>Fecha Final</th>
                    <th>Soporte Fisico</th>
                    <th>Soporte Electronico</th>
                    <th>Caja</th>
                    <th>Carpeta</th>
                    <th>Tomolegajolibro</th>
                    <th>Folios</th>
                    <th>Codigibarrascaja</th>
                    <th>Codigibarrascarpeta</th>
                    <th>Signatura Topografica</th>
                    <th>Otro Tipo</th>
                    <th>Otro Cantidad</th>
                    <th>Electronico Ubicacion</th>
                    <th>Electronico Cantidad</th>
                    <th>Electronico Tamano</th>
                    <th>Notas</th>
                </tr>
            </thead>
            <tbody>
                @isset($resultados)
                    @foreach ($resultados as $registrosfud)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ (string) $registrosfud->serie_codigo }} - {{ $registrosfud->serie_nombre }}</td>
                            <td>{{ (string) $registrosfud->subserie_codigo ?? 'N/A' }} {{ $registrosfud->subserie_nombre ?? 'N/A' }}
                            </td>
                            <td>{{ $registrosfud->unidad_documental }}</td>
                            <td>{{ date('d/m/Y', strtotime($registrosfud->fecha_inicial)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($registrosfud->fecha_final)) }}</td>
                            <td>{{ $registrosfud->soporte_fisico }}</td>
                            <td>{{ $registrosfud->soporte_electronico }}</td>
                            <td>{{ $registrosfud->caja }}</td>
                            <td>{{ $registrosfud->carpeta }}</td>
                            <td>{{ $registrosfud->tomolegajolibro }}</td>
                            <td>{{ $registrosfud->folios }}</td>
                            <td>{{ $registrosfud->codigobarrascaja }}</td>
                            <td>{{ $registrosfud->codigobarrascarpeta }}</td>
                            <td>{{ $registrosfud->signatura_topografica }}</td>
                            <td>{{ $registrosfud->otro_tipo }}</td>
                            <td>{{ $registrosfud->otro_cantidad }}</td>
                            <td>{{ $registrosfud->electronico_ubicacion }}</td>
                            <td>{{ $registrosfud->electronico_cantidad }}</td>
                            <td>{{ $registrosfud->electronico_tamano }}</td>
                            <td>{{ $registrosfud->notas }}</td>
                        </tr>
                    @endforeach
                @endisset
            </tbody>
        </table>
    </div>

    <div class="card-footer bg-light">
        <div class="d-flex justify-content-center">
            @isset($resultados)
                {{ $resultados->links() }}
            @endisset
        </div>
    </div>

    <div class="modal fade" id="modalEspera" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center py-4">
                <div class="modal-body">
                    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                    <h5 class="mt-3">Procesando información...</h5>
                    <p class="text-muted">Por favor, espere unos momentos.</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#registrosTable').DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "paginate": false,
                "info": false,
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "search": "Buscar:",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    }
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const formulario = document.getElementById('frConsulta');
            //const exportForm = document.getElementById('exportForm');

            formulario.addEventListener('submit', function (e) {
                // Muestra el popup usando Bootstrap 5
                var miModal = new bootstrap.Modal(document.getElementById('modalEspera'));
                miModal.show();
            });

            /*exportForm.addEventListener('submit', function (e) {
                // Muestra el popup usando Bootstrap 5
                var miModal = new bootstrap.Modal(document.getElementById('modalEspera'));
                miModal.show();
            });*/
        });

        $('#fecha_inicial').datepicker({
            format: "yyyy-mm-dd",
            language: "es",
            autoclose: true
        });

        $('#fecha_final').datepicker({
            format: "yyyy-mm-dd",
            language: "es",
            autoclose: true
        });

        function loadSubsecciones(seccionSelect) {
            const seccionId = seccionSelect.value;
            const subseccionSelect = document.getElementById('subseccion');
            subseccionSelect.innerHTML = '<option value="">Cargando...</option>';

            if (seccionId > 0) {
                fetch(`secciones/${seccionId}/subsecciones`)
                    .then(response => response.json())
                    .then(data => {
                        let options = '<option value="">Seleccione una subsección</option>';
                        data.forEach(subseccion => {
                            options += `<option value="${subseccion.id}">${subseccion.codigo} - ${subseccion.nombre}</option>`;
                        });
                        subseccionSelect.innerHTML = options;
                    })
                    .catch(error => {
                        console.error('Error al cargar subsecciones:', error);
                        subseccionSelect.innerHTML = '<option value="">Error al cargar</option>';
                    });
            }
        }

        function loadSubseries(serieSelect) {
            const serieId = serieSelect.value;
            const subseccionSelect = document.getElementById('subserie');
            subseccionSelect.innerHTML = '<option value="">Cargando...</option>';

            if (serieId > 0) {
                fetch(`series/${serieId}/subseries`)
                    .then(response => response.json())
                    .then(data => {
                        let options = '<option value="">Seleccione una subserie</option>';
                        data.forEach(subserie => {
                            options += `<option value="${subserie.id}">${subserie.codigo} - ${subserie.nombre}</option>`;
                        });
                        subseccionSelect.innerHTML = options;
                    })
                    .catch(error => {
                        console.error('Error al cargar subseries:', error);
                        subseccionSelect.innerHTML = '<option value="">Error al cargar</option>';
                    });
            }
        }
    </script>
@endsection