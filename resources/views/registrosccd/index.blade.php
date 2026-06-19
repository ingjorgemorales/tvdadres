@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
@endsection

@section('template_title')
    Registrosccds
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title" style="font-size: 1.5rem; font-weight: bold;">
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
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table id="registrosccd" class="table table-striped table-hover table-bordered table-sm shadow-lg mt-4 dataTable_width_auto" style="width:100%">
                                <thead class="thead">
                                    <tr>
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
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registrosccds as $registrosccd)
                                        <tr>
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
                                            <td>
                                                <form action="{{ route('registrosccd.destroy', $registrosccd->id) }}" method="POST">
                                                    @can('View:Registrosccd')
                                                    <a class="btn btn-sm btn-primary " href="{{ route('registrosccd.show', $registrosccd->id) }}"><i class="fa fa-fw fa-eye"></i>Ver</a>
                                                    @endcan
                                                    @can('Update:Registrosccd')
                                                    <a class="btn btn-sm btn-success" href="{{ route('registrosccd.edit', $registrosccd->id) }}"><i class="fa fa-fw fa-edit"></i></a>
                                                    @endcan
                                                    @can('Delete:Registrosccd')
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Está seguro de Borrar?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i>Borrar</button>
                                                    @endcan
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('js')
        <script>
            $(document).ready(function() {
                $('#registrosccd').DataTable({ 
                    "responsive": true,
                    "lengthChange": true,
                    "autoWidth": false,
                    "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]],
                    layout: {
                        topStart: {
                            buttons: ["pageLength", "copy", "csv", "excel", "pdf", "print"],
                        }
                    },
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
                    },
                    columnDefs: [
                        {
                            "targets": [1], // Índice de la columna (0 es la primera)
                            "visible": false,
                            "searchable": false // Opcional: ocultar de la búsqueda
                        }
                    ]
                });
            } );
        </script>
    @endsection
@endsection
