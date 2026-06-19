<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="proceso" class="form-label">{{ __('Proceso') }}</label>
            <input type="text" name="proceso" class="form-control @error('proceso') is-invalid @enderror" value="{{ old('proceso', $cabeceraccd?->proceso) }}" id="proceso" placeholder="Proceso">
            {!! $errors->first('proceso', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="formato" class="form-label">{{ __('Formato') }}</label>
            <input type="text" name="formato" class="form-control @error('formato') is-invalid @enderror" value="{{ old('formato', $cabeceraccd?->formato) }}" id="formato" placeholder="Formato">
            {!! $errors->first('formato', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="codigo" class="form-label">{{ __('Codigo') }}</label>
            <input type="text" name="codigo" class="form-control @error('codigo') is-invalid @enderror" value="{{ old('codigo', $cabeceraccd?->codigo) }}" id="codigo" placeholder="Codigo">
            {!! $errors->first('codigo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="version" class="form-label">{{ __('Version') }}</label>
            <input type="text" name="version" class="form-control @error('version') is-invalid @enderror" value="{{ old('version', $cabeceraccd?->version) }}" id="version" placeholder="Version">
            {!! $errors->first('version', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha" class="form-label">{{ __('Fecha') }}</label>
            <input type="text" name="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha', $cabeceraccd?->fecha) }}" id="fecha" placeholder="Fecha">
            {!! $errors->first('fecha', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="entidad_productora" class="form-label">{{ __('Entidad Productora') }}</label>
            <input type="text" name="entidad_productora" class="form-control @error('entidad_productora') is-invalid @enderror" value="{{ old('entidad_productora', $cabeceraccd?->entidad_productora) }}" id="entidad_productora" placeholder="Entidad Productora">
            {!! $errors->first('entidad_productora', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="oficina" class="form-label">{{ __('Oficina') }}</label>
            <input type="text" name="oficina" class="form-control @error('oficina') is-invalid @enderror" value="{{ old('oficina', $cabeceraccd?->oficina) }}" id="oficina" placeholder="Oficina">
            {!! $errors->first('oficina', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_periodo" class="form-label">{{ __('Periodo') }}</label>
            <select name="id_periodo" class="form-control @error('id_periodo') is-invalid @enderror" id="id_periodo">
                <option value="">{{ __('Seleccione Periodo') }}</option>
                @foreach($periodos as $id => $nombre)
                    <option value="{{ $id }}" {{ old('id_periodo', $cabeceraccd?->id_periodo) == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
            {!! $errors->first('id_periodo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>