@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
@endsection

@section('template_title')
    Series
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title" style="font-size: 1.5rem; font-weight: bold;">
                                Series
                            </span>

                             <div class="float-right">
                                @can('Create:Series')
                                <a href="{{ route('series.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  Crear serie
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
                            <table class="table table-striped table-hover" id="seriesTable">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th >Código</th>
                                        <th >Nombre</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($series as $serie)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $serie->codigo }}</td>
										<td >{{ $serie->nombre }}</td>

                                            <td>
                                                <form action="{{ route('series.destroy', $serie->id) }}" method="POST">
                                                    @can('View:Series')
                                                    <a class="btn btn-sm btn-primary" href="{{ route('series.show', $serie->id) }}"><i class="fa fa-fw fa-eye"></i>Ver</a>
                                                    @endcan
                                                    @can('Update:Series')
                                                    <a class="btn btn-sm btn-success" href="{{ route('series.edit', $serie->id) }}"><i class="fa fa-fw fa-edit"></i>Editar</a>
                                                    @endcan
                                                    @can('Delete:Series')
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
                $('#seriesTable').DataTable({           
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
