<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrosfuidRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'id_cabecerafuid' => 'required',
			'orden' => 'required',
			'id_serie' => 'required',
			'id_subserie' => 'required',
			'unidad_documental' => 'required|string',
			'fecha_inicial' => 'required',
			'fecha_final' => 'required',
			'soporte_fisico' => 'required',
			'soporte_electronico' => 'required',
			'caja' => 'required|string',
			'carpeta' => 'required|string',
			'tomolegajolibro' => 'required|string',
			'folios' => 'required',
			'codigobarrascaja' => 'required',
			'codigobarrascarpeta' => 'required',
			'signatura_topografica' => 'required|string',
			'otro_tipo' => 'required|string',
			'otro_cantidad' => 'required|string',
			'electronico_ubicacion' => 'required|string',
			'electronico_cantidad' => 'required|string',
			'electronico_tamano' => 'required|string',
			'notas' => 'required|string',
        ];
    }
}
