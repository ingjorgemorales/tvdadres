@extends('layouts.app')

@section('template_title')
    Cabecerafuids
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title" style="font-size: 1.5rem; font-weight: bold">
                                Formato Único de Inventario Documental
                            </span>

                             <div class="float-right">
                                @can('Create:Cabecerafuid')
                                <a href="{{ route('cabecerafuid.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  Crear FUID
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
                            <table class="table table-striped table-hover" id="cabecerafuidTable">
                                <thead class="thead">
                                    <tr>
                                        <th></th>
                                        <th>No</th>
                                        <th >Proceso</th>
                                        <th >Formato</th>
                                        <th >Código</th>
                                        <th >Versión</th>
                                        <th >Fecha</th>
                                        <th >Entidad Remitente</th>
                                        <th >Entidad Productora</th>
                                        <th >Objeto</th>
                                        <th >Código Sección</th>
                                        <th >Nombre Sección</th>
                                        <th >Código Subsección</th>
                                        <th >Nombre Subsección</th>
                                        <th >Periodo</th>                               
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cabecerafuids as $cabecerafuid)
                                        <tr>
                                            <td>
                                                <form action="{{ route('cabecerafuid.destroy', $cabecerafuid->id) }}" method="POST">
                                                    @can('View:Cabecerafuid')
                                                    <a href="{{ route('cabecerafuid.show', $cabecerafuid->id) }}" title="Ver" data-bs-toggle="tooltip" data-bs-placement="top" >
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                                        </svg>
                                                    </a>
                                                    @endcan
                                                    @can('Update:Cabecerafuid')
                                                    <a href="{{ route('cabecerafuid.edit', $cabecerafuid->id) }}" title="Editar" data-bs-toggle="tooltip" data-bs-placement="top" >
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                        </svg>
                                                    </a>
                                                    @endcan
                                                    @can('Delete:Cabecerafuid')
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
                                            <td>{{ ++$i }}</td>
                                            
                                            <td >{{ $cabecerafuid->proceso }}</td>
                                            <td >{{ $cabecerafuid->formato }}</td>
                                            <td >{{ $cabecerafuid->codigo }}</td>
                                            <td >{{ $cabecerafuid->version }}</td>
                                            <td >{{ $cabecerafuid->fecha ?? 'N/A' }}</td>
                                            <td >{{ $cabecerafuid->entidad_remitente }}</td>
                                            <td >{{ $cabecerafuid->entidad_productora }}</td>
                                            <td >{{ $cabecerafuid->objeto }}</td>
                                            <td >{{ $cabecerafuid->seccion->codigo ?? 'N/A' }}</td>
                                            <td >{{ $cabecerafuid->seccion->nombre ?? 'N/A' }}</td>
                                            <td >{{ $cabecerafuid->subseccion->codigo ?? 'N/A' }}</td>
                                            <td >{{ $cabecerafuid->subseccion->nombre ?? 'N/A' }}</td>
                                            <td >{{ $cabecerafuid->periodo->nombre ?? 'N/A' }}</td>
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
                $('#cabecerafuidTable').DataTable({  
                    "scrollX": true,    
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
                    },
                    columnDefs: [
                        {
                            target: [6],
                            render: DataTable.render.date()
                        }
                    ]
                });
            } );
        </script>
    @endsection
@endsection
