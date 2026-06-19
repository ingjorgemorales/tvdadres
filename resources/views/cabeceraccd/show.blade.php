@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.6/buttons.bootstrap5.css">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
@endsection

@section('template_title')
    {{ $cabeceraccd->name ?? __('Show') . " " . __('Cabeceraccd') }}
@endsection

@section('content')
        <section class="content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="float-left">
                                <span class="card-title" style="font-weight: bold; font-size: 1.5rem;">Ver Cuadro Clasificación Documental</span>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-primary btn-sm" href="{{ route('cabeceraccd.index') }}"> << Atrás</a>
                            </div>
                        </div>

                        <div class="card-body bg-white">
                            <table class="table table-striped table-sm" id="cuadroccd">
                                <tr>
                                    <td><strong>Proceso:</strong>
                                    {{ $cabeceraccd->proceso }}</td>
                                    <td><strong>Formato:</strong>
                                    {{ $cabeceraccd->formato }}</td>
                                    <td><strong>Codigo:</strong>
                                    {{ $cabeceraccd->codigo }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Version:</strong>
                                    {{ $cabeceraccd->version }}</td>
                                    <td><strong>Fecha:</strong>
                                    {{ $cabeceraccd->fecha }}</td>
                                    <td><strong>Entidad Productora:</strong>
                                    {{ $cabeceraccd->entidad_productora }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Subseccion:</strong>
                                    {{ $cabeceraccd->subseccion->codigo ?? 'N/A' }} -
                                    {{ $cabeceraccd->subseccion->nombre ?? 'N/A' }}</td>
                                    <td><strong>Periodo:</strong>
                                    {{ $cabeceraccd->periodo->nombre ?? 'N/A' }} ({{ date_format($cabeceraccd->periodo->fecha_inicial, 'd/m/Y') ?? 'N/A' }} - {{ date_format($cabeceraccd->periodo->fecha_final, 'd/m/Y') ?? 'N/A' }})</td>
                                    <td></td>
                            </table>
                        </div>

                        <div class="card-header">
                            <div style="display: flex; justify-content: space-between; align-items: center;">

                                <span id="card_title" style="font-size: 1.25rem; font-weight: bold;">
                                    Registros Cuadros Clasificación Documental
                                </span>

                                <div class="float-right">
                                    @can('Create:Registrosccd')
                                    <a href="{{ route('registrosccd.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                    Crear Registro
                                    </a>
                                    @endcan
                                </div>
                            </div>
                        </div>

                        <div class="card-body bg-white">
                            <div class="table-responsive">
                                <table id="registrosccd" class="table table-striped table-hover table-bordered table-sm shadow-lg mt-4 dataTable_width_auto" style="width:100%">
                                    <thead class="thead">
                                        <tr>
                                            <th></th>
                                            <th>No</th>
                                            <th >Cabeceraccd</th>
                                            <th >Acto Administrativo</th>
                                            <th >Funcion</th>
                                            <th >Código Sección</th>
                                            <th >Nombre Sección</th>
                                            <th >Código Subsección</th>
                                            <th >Nombre Subsección</th>
                                            <th >Código Serie</th>
                                            <th >Nombre Serie</th>
                                            <th >Código Suberie</th>
                                            <th >Nombre Subserie</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($registrosccds as $registrosccd)
                                            <tr>
                                                <td>
                                                    <form action="{{ route('registrosccd.destroy', $registrosccd->id) }}" method="POST">
                                                        @can('View:Registrosccd')
                                                        <a href="{{ route('registrosccd.show', $registrosccd->id) }}" title="Ver" data-bs-toggle="tooltip" data-bs-placement="top" >
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                                            </svg>
                                                        </a>
                                                        @endcan
                                                        @can('Update:Registrosccd')
                                                        <a href="{{ route('registrosccd.edit', $registrosccd->id) }}" title="Editar" data-bs-toggle="tooltip" data-bs-placement="top" >
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                            </svg>
                                                        </a>
                                                        @endcan
                                                        @can('Delete:Registrosccd')
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="#" onclick="event.preventDefault(); confirm('Está seguro de Borrar?') ? this.closest('form').submit() : false;" title="Eliminar" data-bs-toggle="tooltip" data-bs-placement="top">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                                            </svg>
                                                        </a>
                                                        @endcan
                                                    </form>
                                                </td>
                                                <td>{{ $i++ }}</td>
                                                <td >{{ $registrosccd->id_cabeceraccd }}</td>
                                                <td >{{ $registrosccd->acto_administrativo }}</td>
                                                <td >{{ $registrosccd->funcion }}</td>
                                                <td >{{ $registrosccd->seccion->codigo ?? '' }}</td>
                                                <td >{{ $registrosccd->seccion->nombre ?? '' }}</td>
                                                <td >{{ $registrosccd->subseccion->codigo ?? '' }}</td>
                                                <td >{{ $registrosccd->subseccion->nombre ?? '' }}</td>
                                                <td >{{ $registrosccd->series->codigo ?? '' }}</td>
                                                <td >{{ $registrosccd->series->nombre ?? '' }}</td>
                                                <td >{{ $registrosccd->subseries->codigo ?? '' }}</td>
                                                <td >{{ $registrosccd->subseries->nombre ?? '' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @section('js')
                            <script>
                                $(document).ready(function() {
                                    $('#registrosccd').DataTable({ 
                                        "columnDefs": [
                                            {
                                                "targets": [2], // Índice de la columna (0 es la primera)
                                                "visible": false,
                                                "searchable": false // Opcional: ocultar de la búsqueda
                                            }
                                        ],
                                        "responsive": true,
                                        "lengthChange": true,
                                        "autoWidth": false,
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
                            </script>
                        @endsection
                    </div>
                </div>
            </div>
        </section>
@endsection
