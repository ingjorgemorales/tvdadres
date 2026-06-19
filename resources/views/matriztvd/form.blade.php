<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="seccion" class="form-label">Sección</label>
            <select name="seccion" onchange="loadSubsecciones(this)" class="form-control @error('seccion') is-invalid @enderror" id="seccion">
                <option value="">Seleccione Sección</option>
                @foreach($secciones as $id => $nombre)
                    <option value="{{ $id }}" {{ old('seccion', $matriztvds?->id_seccion) == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
            {!! $errors->first('seccion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="subseccion" class="form-label">Subsección</label>
            <select name="subseccion" class="form-control @error('subseccion') is-invalid @enderror" id="subseccion">
                <option value="">Seleccione Subsección</option>
            </select>
            {!! $errors->first('subseccion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="serie" class="form-label">Serie</label>
            <select name="serie" class="form-control @error('serie') is-invalid @enderror" id="serie">
                <option value="">Seleccione Serie</option>
                @foreach($series as $id => $nombre)
                    <option value="{{ $id }}" {{ old('serie', $matriztvds?->id_serie) == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
            {!! $errors->first('serie', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="subserie" class="form-label">Subserie</label>
            <select name="subserie" class="form-control @error('subserie') is-invalid @enderror" id="subserie">
                <option value="">Seleccione Subserie</option>
                @foreach($subseries as $id => $nombre)
                    <option value="{{ $id }}" {{ old('subserie', $matriztvds?->id_subserie) == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
            {!! $errors->first('subserie', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>

<script>

    function loadSubsecciones(seccionSelect) {
        const seccionId = seccionSelect.value;
        const subseccionSelect = document.getElementById('subseccion');
        subseccionSelect.innerHTML = '<option value="">Cargando...</option>';

        if (seccionId > 0) {
            fetch(`../secciones/${seccionId}/subsecciones`)
                .then(response => response.json())
                .then(data => {
                    let options = '<option value="">Seleccione una subsección</option>';
                    data.forEach(subseccion => {
                        options += `<option value="${subseccion.id}">${subseccion.nombre}</option>`;
                    });
                    subseccionSelect.innerHTML = options;
                })
                .catch(error => {
                    console.error('Error al cargar subsecciones:', error);
                    subseccionSelect.innerHTML = '<option value="">Error al cargar</option>';
                });
        }
    }

</script>