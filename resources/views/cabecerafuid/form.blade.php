<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="proceso" class="form-label">Proceso</label>
            <input type="text" name="proceso" class="form-control @error('proceso') is-invalid @enderror" value="{{ old('proceso', $cabecerafuid?->proceso) }}" id="proceso" placeholder="Proceso">
            {!! $errors->first('proceso', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="formato" class="form-label">Formato</label>
            <input type="text" name="formato" class="form-control @error('formato') is-invalid @enderror" value="{{ old('formato', $cabecerafuid?->formato) }}" id="formato" placeholder="Formato">
            {!! $errors->first('formato', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="codigo" class="form-label">Código</label>
            <input type="text" name="codigo" class="form-control @error('codigo') is-invalid @enderror" value="{{ old('codigo', $cabecerafuid?->codigo) }}" id="codigo" placeholder="Codigo">
            {!! $errors->first('codigo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="version" class="form-label">Versión</label>
            <input type="text" name="version" class="form-control @error('version') is-invalid @enderror" value="{{ old('version', $cabecerafuid?->version) }}" id="version" placeholder="Version">
            {!! $errors->first('version', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="text" name="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha', $cabecerafuid?->fecha) }}" id="fecha" placeholder="Fecha">
            {!! $errors->first('fecha', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="entidad_remitente" class="form-label">Entidad Remitente</label>
            <input type="text" name="entidad_remitente" class="form-control @error('entidad_remitente') is-invalid @enderror" value="{{ old('entidad_remitente', $cabecerafuid?->entidad_remitente) }}" id="entidad_remitente" placeholder="Entidad Remitente">
            {!! $errors->first('entidad_remitente', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="entidad_productora" class="form-label">Entidad Productora</label>
            <input type="text" name="entidad_productora" class="form-control @error('entidad_productora') is-invalid @enderror" value="{{ old('entidad_productora', $cabecerafuid?->entidad_productora) }}" id="entidad_productora" placeholder="Entidad Productora">
            {!! $errors->first('entidad_productora', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="objeto" class="form-label">Objeto</label>
            <input type="text" name="objeto" class="form-control @error('objeto') is-invalid @enderror" value="{{ old('objeto', $cabecerafuid?->objeto) }}" id="objeto" placeholder="Objeto">
            {!! $errors->first('objeto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_seccion" class="form-label">Sección</label>
            <select name="id_seccion" class="form-control @error('id_seccion') is-invalid @enderror" id="id_seccion">
                <option value="">Seleccione Sección</option>
                @foreach($seccion as $id => $nombre)
                    <option value="{{ $id }}" {{ old('id_seccion', $cabecerafuid?->id_seccion) == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
            {!! $errors->first('id_seccion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_subseccion" class="form-label">Subsección</label>
            <select name="id_subseccion" class="form-control @error('id_subseccion') is-invalid @enderror" id="id_subseccion">
                <option value="">Seleccione Subsección</option>
                @foreach($subseccion as $id => $nombre)
                    <option value="{{ $id }}" {{ old('id_subseccion', $cabecerafuid?->id_subseccion) == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
            {!! $errors->first('id_subseccion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_periodo" class="form-label">Periodo</label>
            <select name="id_periodo" class="form-control @error('id_periodo') is-invalid @enderror" id="id_periodo">
                <option value="">Seleccione Periodo</option>
                @foreach($periodo as $id => $nombre)
                    <option value="{{ $id }}" {{ old('id_periodo', $cabecerafuid?->id_periodo) == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
            {!! $errors->first('id_periodo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>