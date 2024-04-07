<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Libs\ResultResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citas = Cita::all();
        $resultResponse = new ResultResponse();
        $resultResponse->setData($citas);
        $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
        $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);

        return response()->json($resultResponse);
    }

    public function store(Request $request)
    {
        $this->validateCita($request);

        $resultResponse = new ResultResponse();

        try {
            $nuevaCita = new Cita([
                'fecha' => $request->get('fecha'),
                'hora' => $request->get('hora'),
                'valoracion' => $request->get('valoracion'),
                'id_usuario' => $request->get('id_usuario'),
                'id_empleado' => $request->get('id_empleado'),
                'id_tienda' => $request->get('id_tienda'),
            ]);

            $nuevaCita->save();

            $resultResponse->setData($nuevaCita);
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
            $cita = Cita::findOrFail($id);
            $resultResponse->setData($cita);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);  
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
        }

        return response()->json($resultResponse);
    }

    /**
     * Actualiza la cita especificada en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $this->validateCita($request);
        $resultResponse = new ResultResponse();

        try {
            $cita = Cita::findOrFail($id);

            $cita->fecha = $request->get('fecha');
            $cita->hora = $request->get('hora');
            $cita->valoracion = $request->get('valoracion');
            $cita->id_usuario = $request->get('id_usuario');
            $cita->id_empleado = $request->get('id_empleado');
            $cita->id_tienda = $request->get('id_tienda');

            $cita->save();

            $resultResponse->setData($cita);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);  
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }

        return response()->json($resultResponse);
    }

    public function put(Request $request, $id)
    {
        $resultResponse = new ResultResponse();

        try {
            $cita = Cita::where('id', $id)->firstOrFail();

            $cita->fecha = $request->input('fecha', $cita->fecha);
            $cita->hora = $request->input('hora', $cita->hora);
            $cita->valoracion = $request->input('valoracion', $cita->valoracion);
            $cita->id_cliente = $request->input('id_cliente', $cita->id_cliente);
            $cita->id_empleado = $request->input('id_empleado', $cita->id_empleado);
            $cita->id_tienda = $request->input('id_tienda', $cita->id_tienda);

            $cita->save();

            $resultResponse->setData($cita);
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
            $cita = Cita::findOrFail($id);
            $cita->delete();

            $resultResponse->setData($cita);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);  
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
        }

        return response()->json($resultResponse);
    }

    /**
     * Valida los datos de la cita antes de almacenarlos en la base de datos.
     */
    public function validateCita($request)
    {
        $rules = [
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'valoracion' => 'nullable|string|max:1400',
            'id_cliente' => 'required|integer',
            'id_empleado' => 'required|integer',
            'id_tienda' => 'required|integer',
        ];

        $messages = [
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha debe ser una fecha válida.',
            'hora.required' => 'La hora es obligatoria.',
            'hora.date_format' => 'La hora debe tener el formato HH:MM.',
            'valoracion.max' => 'La valoración no puede tener más de :max caracteres.',
            'id_cliente.required' => 'El ID del cliente es obligatorio.',
            'id_cliente.integer' => 'El ID del cliente debe ser un número entero.',
            'id_empleado.required' => 'El ID del empleado es obligatorio.',
            'id_empleado.integer' => 'El ID del empleado debe ser un número entero.',
            'id_tienda.required' => 'El ID de la tienda es obligatorio.',
            'id_tienda.integer' => 'El ID de la tienda debe ser un número entero.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errorMessage = implode(', ', $errors);
            throw new \Exception($errorMessage);
        }
    }

    /**
     * Obtiene la lista de servicios que ofrece una cita.
     */
    public function obtenerServiciosDeCita($id)
    {
        $resultResponse = new ResultResponse();

        try {
            $cita = Cita::findOrFail($id);
            $servicios = $cita->servicios()->get(); // Obtener los servicios asociados a la cita
            $resultResponse->setData($servicios);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);  
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
        }

        return response()->json($resultResponse);
    }

    /**
     * Elimina un servicio de una cita.
     */
    public function eliminarServicioDeCita($citaId, $servicioId)
    {
        $resultResponse = new ResultResponse();

        try {
            $cita = Cita::findOrFail($citaId);
            // Eliminar la relación entre la cita y el servicio
            $cita->servicios()->detach($servicioId);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);  
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }

        return response()->json($resultResponse);
    }

    
}
