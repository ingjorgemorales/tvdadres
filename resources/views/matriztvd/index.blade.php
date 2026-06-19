@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
@endsection

@section('template_title')
    Matriz Tablas Valoración Documental
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title" style="font-size: 1.5rem; font-weight: bold;">
                                {{ __('Matriz Tablas Valoración Documental') }}
                            </span>

                             <div class="float-right">
                                @can('Create:Matriztvd')
                                <a href="{{ route('matriztvd.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  Crear Matriz
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
                            <table id="matriztvdTable" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th >Código Sección</th>
                                        <th >Sección</th>
                                        <th >Código Subsección</th>
                                        <th >Subsección</th>
                                        <th >Código Serie</th>
                                        <th >Serie</th>
                                        <th >Código Suberie</th>
                                        <th >Subserie</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($matriztvds as $matriztvd)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                        
                                            <td >{{ $matriztvd->seccion->codigo ?? '' }}</td>
										    <td >{{ $matriztvd->seccion->nombre ?? '' }}</td>
                                            <td >{{ $matriztvd->subseccion->codigo ?? '' }}</td>
                                            <td >{{ $matriztvd->subseccion->nombre ?? '' }}</td>
                                            <td >{{ $matriztvd->series->codigo ?? '' }}</td>
                                            <td >{{ $matriztvd->series->nombre ?? '' }}</td>
                                            <td >{{ $matriztvd->subseries->codigo ?? '' }}</td>
                                            <td >{{ $matriztvd->subseries->nombre ?? '' }}</td>

                                            <td>
                                                <form action="{{ route('matriztvd.destroy', $matriztvd->id) }}" method="POST">
                                                    @can('View:Matriztvd')
                                                    <a class="btn btn-sm btn-primary " href="{{ route('matriztvd.show', $matriztvd->id) }}"><i class="fa fa-fw fa-eye"></i>Ver</a>
                                                    @endcan
                                                    @can('Update:Matriztvd')
                                                    <a class="btn btn-sm btn-success" href="{{ route('matriztvd.edit', $matriztvd->id) }}"><i class="fa fa-fw fa-edit"></i>Editar</a>
                                                    @endcan
                                                    @can('Delete:Matriztvd')
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Está seguro de Borrar?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Borrar') }}</button>
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
            $(document).ready(function() {
                $('#matriztvdTable').DataTable({           
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
        </script>
    @endsection
@endsection
