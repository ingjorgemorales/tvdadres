<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="id_cabeceraccd" class="form-label">{{ __('Cabeceraccd') }}</label>
            <input type="text" name="id_cabeceraccd" class="form-control @error('id_cabeceraccd') is-invalid @enderror" value="{{ old('id_cabeceraccd', $registrosccd?->id_cabeceraccd) }}" id="id_cabeceraccd" placeholder="Id Cabeceraccd">
            {!! $errors->first('id_cabeceraccd', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="acto_administrativo" class="form-label">{{ __('Acto Administrativo') }}</label>
            <input type="text" name="acto_administrativo" class="form-control @error('acto_administrativo') is-invalid @enderror" value="{{ old('acto_administrativo', $registrosccd?->acto_administrativo) }}" id="acto_administrativo" placeholder="Acto Administrativo">
            {!! $errors->first('acto_administrativo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="funcion" class="form-label">{{ __('Funcion') }}</label>
            <input type="text" name="funcion" class="form-control @error('funcion') is-invalid @enderror" value="{{ old('funcion', $registrosccd?->funcion) }}" id="funcion" placeholder="Funcion">
            {!! $errors->first('funcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_seccion" class="form-label">{{ __('Seccion') }}</label>
            <select name="id_seccion" class="form-control @error('id_seccion') is-invalid @enderror" id="id_seccion">
                <option value="">{{ __('Seleccione Seccion') }}</option>
                @foreach($seccion as $id => $nombre)
                    <option value="{{ $id }}" {{ old('id_seccion', $registrosccd?->id_seccion) == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
            {!! $errors->first('id_seccion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_subseccion" class="form-label">{{ __('Subseccion') }}</label>
            <select name="id_subseccion" class="form-control @error('id_subseccion') is-invalid @enderror" id="id_subseccion">
                <option value="">{{ __('Seleccione Subseccion') }}</option>
                @foreach($subseccion as $id => $nombre)
                    <option value="{{ $id }}" {{ old('id_subseccion', $registrosccd?->id_subseccion) == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
            {!! $errors->first('id_subseccion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_serie" class="form-label">{{ __('Serie') }}</label>
            <select name="id_serie" class="form-control @error('id_serie') is-invalid @enderror" id="id_serie">
                <option value="">{{ __('Seleccione Serie') }}</option>
                @foreach($serie as $id => $nombre)
                    <option value="{{ $id }}" {{ old('id_serie', $registrosccd?->id_serie) == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
            {!! $errors->first('id_serie', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_subserie" class="form-label">{{ __('Subserie') }}</label>
            <select name="id_subserie" class="form-control @error('id_subserie') is-invalid @enderror" id="id_subserie">
                <option value="">{{ __('Seleccione Subserie') }}</option>
                @foreach($subserie as $id => $nombre)
                    <option value="{{ $id }}" {{ old('id_subserie', $registrosccd?->id_subserie) == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
            {!! $errors->first('id_subserie', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>