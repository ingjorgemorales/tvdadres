<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $periodo?->nombre) }}" id="nombre" placeholder="Nombre">
            {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha_inicial" class="form-label">Fecha Inicial</label>
            <input type="text" name="fecha_inicial" class="form-control datepicker @error('fecha_inicial') is-invalid @enderror" value="{{ old('fecha_inicial', $periodo?->fecha_inicial?->format('d-m-Y')) }}" id="fecha_inicial" placeholder="Fecha Inicial">
            {!! $errors->first('fecha_inicial', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha_final" class="form-label">Fecha Final</label>
            <input type="text" name="fecha_final" class="form-control datepicker @error('fecha_final') is-invalid @enderror" value="{{ old('fecha_final', $periodo?->fecha_final?->format('d-m-Y')) }}" id="fecha_final" placeholder="Fecha Final">
            {!! $errors->first('fecha_final', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>

    <script>
        $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            language: "es",
            autoclose: true
        });
    </script>
</div>