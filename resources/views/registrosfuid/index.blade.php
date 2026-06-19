@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
@endsection

@section('template_title')
    Registrosfuids
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title" style="font-size: 1.5rem; font-weight: bold;">
                                Registros de FUID
                            </span>

                             <div class="float-right">
                                @can('Create:Registrosfuid')
                                <a href="{{ route('registrosfuid.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  Crear Registros de FUID
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
                            <table id="registrosfuid" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
									<th >Id Cabecerafuid</th>
									<th >Orden</th>
									<th >Serie</th>
									<th >Subserie</th>
									<th >Unidad Documental</th>
									<th >Fecha Inicial</th>
									<th >Fecha Final</th>
									<th >Soporte Fisico</th>
									<th >Soporte Electronico</th>
									<th >Caja</th>
									<th >Carpeta</th>
									<th >Tomolegajolibro</th>
									<th >Folios</th>
									<th >Codigibarrascaja</th>
									<th >Codigibarrascarpeta</th>
									<th >Signatura Topografica</th>
									<th >Otro Tipo</th>
									<th >Otro Cantidad</th>
									<th >Electronico Ubicacion</th>
									<th >Electronico Cantidad</th>
									<th >Electronico Tamano</th>
									<th >Notas</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registrosfuid as $registrosfud)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $registrosfud->id_cabecerafuid }}</td>
										<td >{{ $registrosfud->orden }}</td>
										<td >{{ $registrosfud->series->nombre ?? 'N/A' }}</td>
										<td >{{ $registrosfud->subseries->nombre ?? 'N/A' }}</td>
										<td >{{ $registrosfud->unidad_documental }}</td>
										<td >{{ $registrosfud->fecha_inicial }}</td>
										<td >{{ $registrosfud->fecha_final }}</td>
										<td >{{ $registrosfud->soporte_fisico }}</td>
										<td >{{ $registrosfud->soporte_electronico }}</td>
										<td >{{ $registrosfud->caja }}</td>
										<td >{{ $registrosfud->carpeta }}</td>
										<td >{{ $registrosfud->tomolegajolibro }}</td>
										<td >{{ $registrosfud->folios }}</td>
										<td >{{ $registrosfud->codigibarrascaja }}</td>
										<td >{{ $registrosfud->codigibarrascarpeta }}</td>
										<td >{{ $registrosfud->signatura_topografica }}</td>
										<td >{{ $registrosfud->otro_tipo }}</td>
										<td >{{ $registrosfud->otro_cantidad }}</td>
										<td >{{ $registrosfud->electronico_ubicacion }}</td>
										<td >{{ $registrosfud->electronico_cantidad }}</td>
										<td >{{ $registrosfud->electronico_tamano }}</td>
										<td >{{ $registrosfud->notas }}</td>

                                            <td>
                                                <form action="{{ route('registrosfuid.destroy', $registrosfud->id) }}" method="POST">
                                                    @can('View:Registrosfuid')
                                                    <a class="btn btn-sm btn-primary " href="{{ route('registrosfuid.show', $registrosfud->id) }}"><i class="fa fa-fw fa-eye"></i>Ver</a>
                                                    @endcan
                                                    @can('Update:Registrosfuid')
                                                    <a class="btn btn-sm btn-success" href="{{ route('registrosfuid.edit', $registrosfud->id) }}"><i class="fa fa-fw fa-edit"></i>Editar</a>
                                                    @endcan
                                                    @can('Delete:Registrosfuid')
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
                $('#registrosfuid').DataTable({ 
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
                    }
                });
            } );
        </script>
    @endsection
@endsection
