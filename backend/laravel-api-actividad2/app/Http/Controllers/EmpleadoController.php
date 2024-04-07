<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Libs\ResultResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = Empleado::all();
        $resultResponse = new ResultResponse();
        $resultResponse->setData($empleados);
        $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
        $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);

        return response()->json($resultResponse);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateEmpleado($request);

        $resultResponse = new ResultResponse();

        try {
            $nuevoEmpleado = new Empleado([
                'nombre_usuario' => $request->input('nombre_usuario'),
                'nombre_completo' => $request->input('nombre_completo'),
                'genero' => $request->input('genero'),
                'direccion' => $request->input('direccion'),
                'ciudad' => $request->input('ciudad'),
                'pais' => $request->input('pais'),
                'correo' => $request->input('correo'),
                'contraseña' => $request->input('contraseña'),
                'telefono' => $request->input('telefono'),
                'salario' => $request->input('salario'),
                'fecha_contratacion' => $request->input('fecha_contratacion'),
                'numero_seguridad_social' => $request->input('numero_seguridad_social'),
                'id_tienda' => $request->input('id_tienda'),
            ]);

            $nuevoEmpleado->save();

            $resultResponse->setData($nuevoEmpleado);

            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);

        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage($e->getMessage());
        }

        return response()->json($resultResponse);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $resultResponse = new ResultResponse();

        try {
            $empleado = Empleado::with('servicios')->findOrFail($id);
            $resultResponse->setData($empleado);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
        }

        return response()->json($resultResponse);
    }

    public function update(Request $request, $id)
    {
        $this->validateEmpleado($request);
        $resultResponse = new ResultResponse();

        try {
            $empleado = Empleado::findOrFail($id);
            $empleado->nombre_usuario = $request->input('nombre_usuario', $empleado->nombre_usuario);
            $empleado->nombre_completo = $request->input('nombre_completo', $empleado->nombre_completo);
            $empleado->genero = $request->input('genero', $empleado->genero);
            $empleado->direccion = $request->input('direccion', $empleado->direccion);
            $empleado->ciudad = $request->input('ciudad', $empleado->ciudad);
            $empleado->pais = $request->input('pais', $empleado->pais);
            $empleado->correo = $request->input('correo', $empleado->correo);
            $empleado->contraseña = $request->input('contraseña', $empleado->contraseña);
            $empleado->telefono = $request->input('telefono', $empleado->telefono);

            $empleado->save();

            $resultResponse->setData($empleado);
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
            $empleado = Empleado::findOrFail($id);

            $empleado->nombre_usuario = $request->input('nombre_usuario', $empleado->nombre_usuario);
            $empleado->nombre_completo = $request->input('nombre_completo', $empleado->nombre_completo);
            $empleado->genero = $request->input('genero', $empleado->genero);
            $empleado->direccion = $request->input('direccion', $empleado->direccion);
            $empleado->ciudad = $request->input('ciudad', $empleado->ciudad);
            $empleado->pais = $request->input('pais', $empleado->pais);
            $empleado->correo = $request->input('correo', $empleado->correo);
            $empleado->contraseña = $request->input('contraseña', $empleado->contraseña);
            $empleado->telefono = $request->input('telefono', $empleado->telefono);

            $empleado->save();

            $resultResponse->setData($empleado);
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
            $empleado = Empleado::findOrFail($id);
            $empleado->delete();

            $resultResponse->setData($empleado);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
        }

        return response()->json($resultResponse);
    }

    /**
     * Validate the employee data before storing it in the database.
     */
    public function validateEmpleado($request)
    {
        $rules = [
            'nombre_usuario' => 'required|string|max:20',
            'nombre_completo' => 'required|string|max:255',
            'genero' => 'nullable|string|max:40',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:40',
            'pais' => 'required|string|max:40',
            'correo' => 'required|string|max:40',
            'contraseña' => 'required|string|max:40',
            'telefono' => 'required|integer',
            'salario' => 'required|integer',
            'fecha_contratacion' => 'required|date',
            'numero_seguridad_social' => 'required|string|max:20',
            'id_tienda' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errorMessage = implode(', ', $errors);
            throw new \Exception($errorMessage);
        }
    }

    public function obtenerServicios($empleadoId)
    {
        $resultResponse = new ResultResponse();

        try {
            $empleado = Empleado::findOrFail($empleadoId);
            $servicios = $empleado->servicios()->get();
            $resultResponse->setData($servicios);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);  
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
        }

        return response()->json($resultResponse);
    }

    public function eliminarServicio($empleadoId, $servicioId)
    {
        $resultResponse = new ResultResponse();

        try {
            $empleado = Empleado::findOrFail($empleadoId);
            $empleado->servicios()->detach($servicioId);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);  
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }

        return response()->json($resultResponse);
    }

}