@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.standalone.css')}}">
@endsection

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Consulta de Cuadros de Clasificación Documental</h3>
                </div>
                <div class="card-body">
                    {{-- Mensaje de éxito --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form id="frConsulta" action="{{ route('consulta.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="seccion" class="form-label">Sección</label>
                                <select name="seccion" id="seccion" onchange="loadSubsecciones(this)" class="form-control @error('seccion') is-invalid @enderror">
                                    <option value="">Seleccione una sección</option>
                                    @foreach($secciones as $seccion)
                                        <option value="{{ $seccion->id }}">{{ $seccion->codigo }} - {{ $seccion->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('seccion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="subseccion" class="form-label">Subsección</label>
                                <select name="subseccion" id="subseccion" class="form-control @error('subseccion') is-invalid @enderror">
                                    <option value="">Seleccione una subsección</option>
                                </select>
                                @error('subseccion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="serie" class="form-label">Serie</label>
                                <select name="serie" id="serie" onchange="loadSubseries(this)" class="form-control @error('serie') is-invalid @enderror">
                                    <option value="">Seleccione una serie</option>
                                    @foreach($series as $serie)
                                        <option value="{{ $serie->id }}">{{ $serie->codigo }} - {{ $serie->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('serie')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="subserie" class="form-label">Subserie</label>
                                <select name="subserie" id="subserie" class="form-control @error('subserie') is-invalid @enderror">
                                    <option value="">Seleccione una subserie</option>
                                </select>
                                @error('subserie')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="periodo" class="form-label">Periodo</label>
                                <select name="periodo" id="periodo" class="form-control @error('periodo') is-invalid @enderror">
                                    <option value="">Seleccione un periodo</option>
                                    @foreach($periodos as $periodo)
                                        <option value="{{ $periodo->id }}" @selected(old('periodo') == $periodo->id)>{{ $periodo->nombre }} ({{ date('d/m/Y', strtotime($periodo->fecha_inicial)) }} - {{ date('d/m/Y', strtotime($periodo->fecha_final)) }})</option>
                                    @endforeach
                                </select>
                                @error('periodo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>
                        
                        @can('View:Consulta')
                        <button type="submit" class="btn btn-primary">Consultar</button>
                        @endcan
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


    <div class="mt-4">
        @can('View:Consulta')
        <form id="exportForm" action="{{ route('consulta.export') }}" method="POST">
            @csrf
                <input type="hidden" name="seccion" value="{{ request('seccion') }}">
                <input type="hidden" name="subseccion" value="{{ request('subseccion') }}">
                <input type="hidden" name="serie" value="{{ request('serie') }}">
                <input type="hidden" name="subserie" value="{{ request('subserie') }}">
                <input type="hidden" name="periodo" value="{{ request('periodo') }}">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary">Exportar a Excel</button>
        </form>
        @endcan
    </div>
</br>
    <div class="table-responsive">
        <table id="registrosTable"
            class="table table-striped table-hover table-bordered table-sm shadow-lg mt-4 dataTable_width_auto"
            style="width:100%">
            <thead class="thead bg-primary text-white">
                <tr>
                    <th>No</th>
                    <th>Acto Administrativo</th>
                    <th>Funcion</th>
                    <th>Código Sección</th>
                    <th>Nombre Sección</th>
                    <th>Código Subsección</th>
                    <th>Nombre Subsección</th>
                    <th>Código Serie</th>
                    <th>Nombre Serie</th>
                    <th>Código Subserie</th>
                    <th>Nombre Subserie</th>
                </tr>
            </thead>
            <tbody>
                @isset($resultados)
                @foreach ($resultados as $registros)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $registros->acto_administrativo }}</td>
                    <td>{{ $registros->funcion }}</td>
                    <td>{{ $registros->seccion_codigo }}</td>
                    <td>{{ $registros->seccion_nombre }}</td>
                    <td>{{ $registros->subseccion_codigo }}</td>
                    <td>{{ $registros->subseccion_nombre }}</td>
                    <td>{{ $registros->serie_codigo }}</td>
                    <td>{{ $registros->serie_nombre }}</td>
                    <td>{{ $registros->subserie_codigo }}</td>
                    <td>{{ $registros->subserie_nombre }}</td>
                </tr>

                @endforeach
                @endisset
            </tbody>
        </table>
    </div>

<div class="modal fade" id="modalEspera" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
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

@section('js')
<script>    
    $(document).ready(function() {
                $('#registrosTable').DataTable({           
                    "responsive": true,
                    "lengthChange": true,
                    "autoWidth": false,
                    "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]],
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
            } );

            document.addEventListener('DOMContentLoaded', function () {
            const formulario = document.getElementById('frConsulta');
            const exportForm = document.getElementById('exportForm');

            formulario.addEventListener('submit', function (e) {
                // Muestra el popup usando Bootstrap 5
                var miModal = new bootstrap.Modal(document.getElementById('modalEspera'));
                miModal.show();
            });

            exportForm.addEventListener('submit', function (e) {
                // Muestra el popup usando Bootstrap 5
                var miModal = new bootstrap.Modal(document.getElementById('modalEspera'));
                miModal.show();
            });
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
@endsection