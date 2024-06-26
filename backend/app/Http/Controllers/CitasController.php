<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Libs\ResultResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use App\Models\Usuario;

class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citas = Cita::paginate(10);
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

    public function patch(Request $request, $id)
    {
        $resultResponse = new ResultResponse();

        try {
            $cita = Cita::where('id', $id)->firstOrFail();

            $cita->fecha = $request->input('fecha', $cita->fecha);
            $cita->hora = $request->input('hora', $cita->hora);
            $cita->id_usuario = $request->input('id_usuario', $cita->id_usuario);
            $cita->id_empleado = $request->input('id_empleado', $cita->id_empleado);
            $cita->id_tienda = $request->input('id_tienda', $cita->id_tienda);

            $cita->save();

            $resultResponse->setData($cita);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);  
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage($e->getMessage());
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
            'id_usuario' => 'required|integer',
            'id_empleado' => 'required|integer',
            'id_tienda' => 'required|integer',
        ];

        $messages = [
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha debe ser una fecha válida.',
            'hora.required' => 'La hora es obligatoria.',
            'hora.date_format' => 'La hora debe tener el formato HH:MM.',
            'id_usuario.required' => 'El ID del usuario es obligatorio.',
            'id_usuario.integer' => 'El ID del usuario debe ser un número entero.',
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
            $cita->servicios()->detach($servicioId);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);  
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }

        return response()->json($resultResponse);
    }


    public function asignarServicioACita($citaId, $servicioId)
    {
        $resultResponse = new ResultResponse();

        try {
            // Encontrar la cita
            $cita = Cita::findOrFail($citaId);
            
            // Asignar el servicio a la cita
            $cita->servicios()->attach($servicioId);

            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage($e->getMessage());
        }

        return response()->json($resultResponse);
    }

    /**
     * Obtiene las citas por ID de empleado.
     */
    public function obtenerCitasPorEmpleado($idEmpleado)
    {
        $resultResponse = new ResultResponse();

        try {
            $citas = Cita::where('id_empleado', $idEmpleado)->paginate(10);
            $resultResponse->setData($citas);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }

        return response()->json($resultResponse);
    }

    public function obtenerCitasPorDniUsuario($dni)
    {
        $resultResponse = new ResultResponse();

        try {
            $usuario = Usuario::where('dni', $dni)->first();

            if ($usuario) {
                $citas = Cita::where('id_usuario', $usuario->id)->paginate(10);

                $resultResponse->setData($citas);
                $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
                $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
            } else {
                $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
                $resultResponse->setMessage("No se encontró ningún usuario con el DNI proporcionado.");
            }
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }
        
        return response()->json($resultResponse);
    }

    public function buscar(Request $request)
    {
        $resultResponse = new ResultResponse();

        try {
            $query = Cita::query();

            if ($request->has('fecha')) {
                $query->where('fecha', 'like', '%' . $request->input('fecha') . '%');
            }

            if ($request->has('hora')) {
                $query->where('hora', 'like', '%' . $request->input('hora') . '%');
            }

            if ($request->has('id_usuario')) {
                $query->where('id_usuario', $request->input('id_usuario'));
            }

            if ($request->has('id_empleado')) {
                $query->where('id_empleado', $request->input('id_empleado'));
            }

            if ($request->has('id_tienda')) {
                $query->where('id_tienda', $request->input('id_tienda'));
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

    
}
