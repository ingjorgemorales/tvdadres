@extends('layouts.app')

@section('template_title')
    Importar Formato Único de Inventario Documental
@endsection

@section('content')

<div class="container mt-5" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Importar Formato Único de Inventario Documental</h3>
                </div>
                <div class="card-body">
                    
                    {{-- Mensaje de éxito --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form id="frImport" action="{{ route('importfuid.importcsv') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="filecsv" class="form-label">Seleccione Archivo CSV</label>
                            <input type="file" name="filecsv" id="filecsv" class="form-control @error('filecsv') is-invalid @enderror" value="{{ old('filecsv') }}">
                            @error('filecsv')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Importar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
        document.addEventListener('DOMContentLoaded', function () {
            const formulario = document.getElementById('frImport');
            
            formulario.addEventListener('submit', function (e) {
                // Muestra el popup usando Bootstrap 5
                var miModal = new bootstrap.Modal(document.getElementById('modalEspera'));
                miModal.show();
            });
        });
    </script>
@endsection

@endsection