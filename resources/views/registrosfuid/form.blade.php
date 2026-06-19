<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="id_cabecerafuid" class="form-label">{{ __('Id Cabecerafuid') }}</label>
            <input type="text" name="id_cabecerafuid" class="form-control @error('id_cabecerafuid') is-invalid @enderror" value="{{ old('id_cabecerafuid', $registrosfuid?->id_cabecerafuid) }}" id="id_cabecerafuid" placeholder="Id Cabecerafuid">
            {!! $errors->first('id_cabecerafuid', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="orden" class="form-label">{{ __('Orden') }}</label>
            <input type="text" name="orden" class="form-control @error('orden') is-invalid @enderror" value="{{ old('orden', $registrosfuid?->orden) }}" id="orden" placeholder="Orden">
            {!! $errors->first('orden', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_serie" class="form-label">{{ __('Id Serie') }}</label>
            <select name="id_serie" class="form-control @error('Serie') is-invalid @enderror" id="id_serie">
                <option value="">{{ __('Seleccione Serie') }}</option>
                @foreach($series as $id => $nombre)
                    <option value="{{ $id }}" {{ old('id_serie', $registrosfuid?->id_serie) == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
            {!! $errors->first('id_serie', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="id_subserie" class="form-label">{{ __('Subserie') }}</label>
            <select name="id_subserie" class="form-control @error('id_subserie') is-invalid @enderror" id="id_subserie">
                <option value="">{{ __('Seleccione Subserie') }}</option>
                @foreach($subseries as $id => $nombre)
                    <option value="{{ $id }}" {{ old('id_subserie', $registrosfuid?->id_subserie) == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                @endforeach
            </select>
            {!! $errors->first('id_subserie', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="unidad_documental" class="form-label">{{ __('Unidad Documental') }}</label>
            <input type="text" name="unidad_documental" class="form-control @error('unidad_documental') is-invalid @enderror" value="{{ old('unidad_documental', $registrosfuid?->unidad_documental) }}" id="unidad_documental" placeholder="Unidad Documental">
            {!! $errors->first('unidad_documental', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha_inicial" class="form-label">{{ __('Fecha Inicial') }}</label>
            <input type="text" name="fecha_inicial" class="form-control @error('fecha_inicial') is-invalid @enderror" value="{{ old('fecha_inicial', $registrosfuid?->fecha_inicial) }}" id="fecha_inicial" placeholder="Fecha Inicial">
            {!! $errors->first('fecha_inicial', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha_final" class="form-label">{{ __('Fecha Final') }}</label>
            <input type="text" name="fecha_final" class="form-control @error('fecha_final') is-invalid @enderror" value="{{ old('fecha_final', $registrosfuid?->fecha_final) }}" id="fecha_final" placeholder="Fecha Final">
            {!! $errors->first('fecha_final', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="soporte_fisico" class="form-label">{{ __('Soporte Fisico') }}</label>
            <input type="text" name="soporte_fisico" class="form-control @error('soporte_fisico') is-invalid @enderror" value="{{ old('soporte_fisico', $registrosfuid?->soporte_fisico) }}" id="soporte_fisico" placeholder="Soporte Fisico">
            {!! $errors->first('soporte_fisico', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="soporte_electronico" class="form-label">{{ __('Soporte Electronico') }}</label>
            <input type="text" name="soporte_electronico" class="form-control @error('soporte_electronico') is-invalid @enderror" value="{{ old('soporte_electronico', $registrosfuid?->soporte_electronico) }}" id="soporte_electronico" placeholder="Soporte Electronico">
            {!! $errors->first('soporte_electronico', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="caja" class="form-label">{{ __('Caja') }}</label>
            <input type="text" name="caja" class="form-control @error('caja') is-invalid @enderror" value="{{ old('caja', $registrosfuid?->caja) }}" id="caja" placeholder="Caja">
            {!! $errors->first('caja', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="carpeta" class="form-label">{{ __('Carpeta') }}</label>
            <input type="text" name="carpeta" class="form-control @error('carpeta') is-invalid @enderror" value="{{ old('carpeta', $registrosfuid?->carpeta) }}" id="carpeta" placeholder="Carpeta">
            {!! $errors->first('carpeta', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="tomolegajolibro" class="form-label">{{ __('Tomolegajolibro') }}</label>
            <input type="text" name="tomolegajolibro" class="form-control @error('tomolegajolibro') is-invalid @enderror" value="{{ old('tomolegajolibro', $registrosfuid?->tomolegajolibro) }}" id="tomolegajolibro" placeholder="Tomolegajolibro">
            {!! $errors->first('tomolegajolibro', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="folios" class="form-label">{{ __('Folios') }}</label>
            <input type="text" name="folios" class="form-control @error('folios') is-invalid @enderror" value="{{ old('folios', $registrosfuid?->folios) }}" id="folios" placeholder="Folios">
            {!! $errors->first('folios', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="codigibarrascaja" class="form-label">{{ __('Codigibarrascaja') }}</label>
            <input type="text" name="codigibarrascaja" class="form-control @error('codigibarrascaja') is-invalid @enderror" value="{{ old('codigibarrascaja', $registrosfuid?->codigibarrascaja) }}" id="codigibarrascaja" placeholder="Codigibarrascaja">
            {!! $errors->first('codigibarrascaja', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="codigibarrascarpeta" class="form-label">{{ __('Codigibarrascarpeta') }}</label>
            <input type="text" name="codigibarrascarpeta" class="form-control @error('codigibarrascarpeta') is-invalid @enderror" value="{{ old('codigibarrascarpeta', $registrosfuid?->codigibarrascarpeta) }}" id="codigibarrascarpeta" placeholder="Codigibarrascarpeta">
            {!! $errors->first('codigibarrascarpeta', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="signatura_topografica" class="form-label">{{ __('Signatura Topografica') }}</label>
            <input type="text" name="signatura_topografica" class="form-control @error('signatura_topografica') is-invalid @enderror" value="{{ old('signatura_topografica', $registrosfuid?->signatura_topografica) }}" id="signatura_topografica" placeholder="Signatura Topografica">
            {!! $errors->first('signatura_topografica', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="otro_tipo" class="form-label">{{ __('Otro Tipo') }}</label>
            <input type="text" name="otro_tipo" class="form-control @error('otro_tipo') is-invalid @enderror" value="{{ old('otro_tipo', $registrosfuid?->otro_tipo) }}" id="otro_tipo" placeholder="Otro Tipo">
            {!! $errors->first('otro_tipo', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="otro_cantidad" class="form-label">{{ __('Otro Cantidad') }}</label>
            <input type="text" name="otro_cantidad" class="form-control @error('otro_cantidad') is-invalid @enderror" value="{{ old('otro_cantidad', $registrosfuid?->otro_cantidad) }}" id="otro_cantidad" placeholder="Otro Cantidad">
            {!! $errors->first('otro_cantidad', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="electronico_ubicacion" class="form-label">{{ __('Electronico Ubicacion') }}</label>
            <input type="text" name="electronico_ubicacion" class="form-control @error('electronico_ubicacion') is-invalid @enderror" value="{{ old('electronico_ubicacion', $registrosfuid?->electronico_ubicacion) }}" id="electronico_ubicacion" placeholder="Electronico Ubicacion">
            {!! $errors->first('electronico_ubicacion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="electronico_cantidad" class="form-label">{{ __('Electronico Cantidad') }}</label>
            <input type="text" name="electronico_cantidad" class="form-control @error('electronico_cantidad') is-invalid @enderror" value="{{ old('electronico_cantidad', $registrosfuid?->electronico_cantidad) }}" id="electronico_cantidad" placeholder="Electronico Cantidad">
            {!! $errors->first('electronico_cantidad', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="electronico_tamano" class="form-label">{{ __('Electronico Tamano') }}</label>
            <input type="text" name="electronico_tamano" class="form-control @error('electronico_tamano') is-invalid @enderror" value="{{ old('electronico_tamano', $registrosfuid?->electronico_tamano) }}" id="electronico_tamano" placeholder="Electronico Tamano">
            {!! $errors->first('electronico_tamano', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="notas" class="form-label">{{ __('Notas') }}</label>
            <input type="text" name="notas" class="form-control @error('notas') is-invalid @enderror" value="{{ old('notas', $registrosfuid?->notas) }}" id="notas" placeholder="Notas">
            {!! $errors->first('notas', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>