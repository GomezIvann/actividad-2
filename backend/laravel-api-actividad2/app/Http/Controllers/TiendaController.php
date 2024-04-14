<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use App\Libs\ResultResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;


class TiendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiendas = Tienda::paginate(10);
        $resultResponse = new ResultResponse();
        $resultResponse->setData($tiendas);
        $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
        $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);

        return response()->json($resultResponse);
    }

    public function store(Request $request)
    {
        $this->validateTienda($request);

        $resultResponse = new ResultResponse();

        try {
            $nuevaTienda = new Tienda([
                'horario' => $request->get('horario'),
                'direccion' => $request->get('direccion'),
                'telefono' => $request->get('telefono'),
                'capacidad' => $request->get('capacidad'),
                'estado' => $request->get('estado'), 
                'imagen' => $request->get('imagen')
            ]);

            $nuevaTienda->save();

            $resultResponse->setData($nuevaTienda);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }

        return response()->json($resultResponse);
    }

    public function show($id)
    {
        $resultResponse = new ResultResponse();

        try {
            $tienda = Tienda::findOrFail($id);
            $resultResponse->setData($tienda);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);  
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
        }

        return response()->json($resultResponse);
    }

        /**
     * Actualiza la tienda especificada en la base de datos.
     */
    public function update(Request $request, $tiendaId)
    {
        $this->validateTienda($request);
        $resultResponse = new ResultResponse();

        try {
            $tienda = Tienda::findOrFail($tiendaId);
            $tienda->horario = $request->get('horario');
            $tienda->direccion = $request->get('direccion');
            $tienda->telefono = $request->get('telefono');
            $tienda->capacidad = $request->get('capacidad');
            $tienda->estado = $request->get('estado'); 
            $tienda->imagen = $request->get('imagen'); 

            $tienda->save();

            $resultResponse->setData($tienda);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);  
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }

        return response()->json($resultResponse);
    }

    /**
 * Actualiza la tienda especificada en la base de datos.
 */
public function patch(Request $request, $id)
{
    $resultResponse = new ResultResponse();

    try {
        $tienda = Tienda::findOrFail($id);

        $tienda->horario = $request->input('horario', $tienda->horario);
        $tienda->direccion = $request->input('direccion', $tienda->direccion);
        $tienda->telefono = $request->input('telefono', $tienda->telefono);
        $tienda->capacidad = $request->input('capacidad', $tienda->capacidad);
        $tienda->estado = $request->get('estado', $tienda->estado); 
        $tienda->imagen = $request->get('imagen', $tienda->imagen); 

        $tienda->save();

        $resultResponse->setData($tienda);
        $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
        $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);  
    } catch (\Exception $e) {
        $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
        $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
    }

    return response()->json($resultResponse);
}



    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $resultResponse = new ResultResponse();

        try {
            $tienda = Tienda::findOrFail($id);
            $tienda->delete();

            $resultResponse->setData($tienda);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);  
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
        }

        return response()->json($resultResponse);
    }

    public function buscar(Request $request)
    {
     
        $resultResponse = new ResultResponse();

        try {
            $query = Tienda::query();

            if ($request->has('horario')) {
                $query->where('horario', 'like', '%' . $request->input('horario') . '%');
            }

            if ($request->has('direccion')) {
                $query->where('direccion', 'like', '%' . $request->input('direccion') . '%');
            }

            if ($request->has('telefono')) {
                $query->where('telefono', 'like', '%' . $request->input('telefono') . '%');
            }

            if ($request->has('estado')) {
                $query->where('estado', 'like', '%' . $request->input('estado') . '%');
            }

            $resultados = $query->paginate(10);

            $resultResponse->setData($resultados);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }

        return response()->json($resultResponse);
    }

    /**
     * Valida los datos de la tienda antes de almacenarlos en la base de datos.
     */
    public function validateTienda($request)
    {
        $rules = [
            'horario' => 'required|string',
            'direccion' => 'required|string',
            'telefono' => 'required|string|max:20',
            'capacidad' => 'required|integer|min:0',
            'estado' => 'required|string', // Reglas de validación para el campo estado
            'imagen' => 'required|string', // Reglas de validación para el campo imagen
        ];

        $messages = [
            'horario.required' => 'El horario es obligatorio.',
            'direccion.required' => 'La dirección es obligatoria.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.max' => 'El teléfono no puede tener más de :max caracteres.',
            'capacidad.required' => 'La capacidad es obligatoria.',
            'capacidad.integer' => 'La capacidad debe ser un número entero.',
            'capacidad.min' => 'La capacidad debe ser como mínimo :min.',
            'estado.required' => 'El estado es obligatorio.', // Mensaje de validación para el campo estado
            'imagen.required' => 'La imagen es obligatoria.', // Mensaje de validación para el campo imagen
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errorMessage = implode(', ', $errors);
            throw new \Exception($errorMessage);
        }

    }
}
