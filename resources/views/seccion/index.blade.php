@extends('layouts.app')

@section('template_title')
    Seccion
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title" style="font-size: 1.5rem; font-weight: bold;">
                                Sección
                            </span>

                             <div class="float-right">
                                @can('Create:Seccion')
                                <a href="{{ route('seccion.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  Crear Sección
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
                            <table class="table table-striped table-hover" id="seccionTable">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>                                
                                        <th >Código</th>
                                        <th >Nombre</th>
                                        <th >Tipo</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($secciones as $seccion)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $seccion->codigo }}</td>
										<td >{{ $seccion->nombre }}</td>
										<td >{{ $seccion->tiposeccion->nombre }}</td>

                                            <td>
                                                <form action="{{ route('seccion.destroy', $seccion->id) }}" method="POST">
                                                    @can('View:Seccion')
                                                    <a class="btn btn-sm btn-primary " href="{{ route('seccion.show', $seccion->id) }}"><i class="fa fa-fw fa-eye"></i>Ver</a>
                                                    @endcan
                                                    @can('Update:Seccion')
                                                    <a class="btn btn-sm btn-success" href="{{ route('seccion.edit', $seccion->id) }}"><i class="fa fa-fw fa-edit"></i>Editar</a>
                                                    @endcan
                                                    @can('Delete:Seccion')
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
                $('#seccionTable').DataTable({           
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
