@extends('layouts.app')

@section('css')

    <style>
        div.dt-container {
            width: 100%;
            margin: 0 auto;
        }
    </style>
@endsection

@section('template_title')
    {{ $cabecerafuid->name ?? __('Show') . ' ' . __('Cabecerafuid') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title" style="font-weight: bold; font-size: 1.5rem;">Ver Formato Único de
                                Inventario Documental</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('cabecerafuid.index') }}">
                                << Atrás</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <table class="table table-striped table-sm" id="cuadroccd">
                            <tr>
                                <td>
                                    <strong>Proceso:</strong>
                                    {{ $cabecerafuid->proceso }}
                                </td>
                                <td>
                                    <strong>Formato:</strong>
                                    {{ $cabecerafuid->formato }}
                                </td>
                                <td>
                                    <strong>Codigo:</strong>
                                    {{ $cabecerafuid->codigo }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Version:</strong>
                                    {{ $cabecerafuid->version }}
                                </td>
                                <td>
                                    <strong>Fecha:</strong>
                                    {{ date('d-m-Y', strtotime($cabecerafuid->fecha)) }}
                                </td>
                                <td>
                                    <strong>Entidad Remitente:</strong>
                                    {{ $cabecerafuid->entidad_remitente }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Entidad Productora:</strong>
                                    {{ $cabecerafuid->entidad_productora }}
                                </td>
                                <td>
                                    <strong>Objeto:</strong>
                                    {{ $cabecerafuid->objeto }}
                                </td>
                                <td>
                                    <strong>Seccion:</strong>
                                    {{ $cabecerafuid->seccion->codigo ?? '' }} -
                                    {{ $cabecerafuid->seccion->nombre ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Subseccion:</strong>
                                    {{ $cabecerafuid->subseccion->codigo ?? '' }} -
                                    {{ $cabecerafuid->subseccion->nombre ?? '' }}
                                </td>
                                <td>
                                    <strong>Periodo:</strong>
                                    {{ $cabecerafuid->periodo->nombre ?? '' }}
                                    ({{ date('d-m-Y', strtotime($cabecerafuid->periodo->fecha_inicial ?? '')) }} -
                                    {{ date('d-m-Y', strtotime($cabecerafuid->periodo->fecha_final ?? '')) }})
                                </td>
                                <td></td>
                            </tr>
                        </table>
                    </div>

                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title" style="font-size: 1.25rem; font-weight: bold;">
                                Registros de FUID
                            </span>

                            <div class="float-right">
                                @can('Create:Registrosfuid')
                                <a href="{{ route('registrosfuid.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    Crear Registros de FUID
                                </a>
                                @endcan
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table id="registrosfuid" class="table table-striped table-hover display">
                                <thead class="thead">
                                    <tr>
                                        <th></th>
                                        <th>No</th>
                                        <th>Id Cabecerafuid</th>
                                        <th>Orden</th>
                                        <th>Código Serie</th>
                                        <th>Nombre Serie</th>
                                        <th>Código Subserie</th>
                                        <th>Nombre Subserie</th>
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
                                    @foreach ($registrosfuids as $registrosfud)
                                        <tr>
                                            <td>
                                                <form action="{{ route('registrosfuid.destroy', $registrosfud->id) }}" method="POST">
                                                    @can('View:Registrosfuid')
                                                    <a href="{{ route('registrosfuid.show', $registrosfud->id) }}" title="Ver" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                                        </svg>
                                                    </a>
                                                    @endcan
                                                    @can('Update:Registrosfuid')
                                                    <a href="{{ route('registrosfuid.edit', $registrosfud->id) }}" title="Editar" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                        </svg>
                                                    </a>
                                                    @endcan
                                                    @can('Delete:Registrosfuid')
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="#" onclick="event.preventDefault(); confirm('Está seguro de Borrar?') ? this.closest('form').submit() : false;"
                                                        title="Borrar" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                                        </svg>
                                                    </a>
                                                    @endcan
                                                </form>
                                            </td>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $registrosfud->id_cabecerafuid }}</td>
                                            <td>{{ $registrosfud->orden }}</td>
                                            <td>{{ $registrosfud->series->codigo ?? 'N/A' }}</td>
                                            <td>{{ $registrosfud->series->nombre ?? 'N/A' }}</td>
                                            <td>{{ $registrosfud->subseries->codigo ?? 'N/A' }}</td>
                                            <td>{{ $registrosfud->subseries->nombre ?? 'N/A' }}</td>
                                            <td>{{ $registrosfud->unidad_documental }}</td>
                                            <td>{{ $registrosfud->fecha_inicial }}</td>
                                            <td>{{ $registrosfud->fecha_final }}</td>
                                            <td>{{ $registrosfud->soporte_fisico }}</td>
                                            <td>{{ $registrosfud->soporte_electronico }}</td>
                                            <td>{{ $registrosfud->caja }}</td>
                                            <td>{{ $registrosfud->carpeta }}</td>
                                            <td>{{ $registrosfud->tomolegajolibro }}</td>
                                            <td>{{ $registrosfud->folios }}</td>
                                            <td>{{ $registrosfud->codigibarrascaja }}</td>
                                            <td>{{ $registrosfud->codigibarrascarpeta }}</td>
                                            <td>{{ $registrosfud->signatura_topografica }}</td>
                                            <td>{{ $registrosfud->otro_tipo }}</td>
                                            <td>{{ $registrosfud->otro_cantidad }}</td>
                                            <td>{{ $registrosfud->electronico_ubicacion }}</td>
                                            <td>{{ $registrosfud->electronico_cantidad }}</td>
                                            <td>{{ $registrosfud->electronico_tamano }}</td>
                                            <td>{{ $registrosfud->notas }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@section('js')
    <script>
        $(document).ready(function() {
            $('#registrosfuid').DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "lengthMenu": [
                    [5, 10, 50, -1],
                    [5, 10, 50, "All"]
                ],
                "scrollX": true,
                "columnDefs": [{
                        "targets": [2],
                        "visible": false,
                        "searchable": false // Opcional: ocultar de la búsqueda
                    },
                    {
                        "targets": [3],
                        "visible": false,
                        "searchable": false // Opcional: ocultar de la búsqueda
                    },
                    {
                        target: [9, 10], // Índices de las columnas de fecha
                        render: DataTable.render.date() // Formato de fecha deseado
                    }
                ],
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
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
    </script>
@endsection
@endsection
