<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CabecerafuidRequest extends FormRequest
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
			'proceso' => 'required|string',
			'formato' => 'required|string',
			'codigo' => 'required|string',
			'version' => 'required|string',
			'fecha' => 'required',
			'entidad_remitente' => 'required|string',
			'entidad_productora' => 'required|string',
			'objeto' => 'required|string',
			'id_seccion' => 'required',
			'id_subseccion' => 'required',
			'id_periodo' => 'required',
        ];
    }
}
