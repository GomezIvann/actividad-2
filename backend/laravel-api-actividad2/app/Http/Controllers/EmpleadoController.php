<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Libs\ResultResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = Empleado::paginate(10);
        $resultResponse = new ResultResponse();
        $resultResponse->setData($empleados);
        $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
        $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);

        return response()->json($resultResponse);
    }

    public function store(Request $request)
    {
        $this->validateEmpleado($request);

        $resultResponse = new ResultResponse();

        try {
            $nuevoEmpleado = new Empleado([
                'nombre' => $request->input('nombre'),
                'apellidos' => $request->input('apellidos'),
                'ciudad' => $request->input('ciudad'),
                'pais' => $request->input('pais'),
                'imagen' => $request->input('imagen'),
                'red_social' => $request->input('red_social'), // Agregado el campo red_social
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
            $empleado->nombre = $request->get('nombre');
            $empleado->apellidos = $request->get('apellidos');
            $empleado->ciudad = $request->get('ciudad');
            $empleado->pais = $request->get('pais');
            $empleado->imagen = $request->get('imagen');
            $empleado->red_social = $request->get('red_social'); // Agregado el campo red_social
            $empleado->id_tienda = $request->get('id_tienda');

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

    public function patch(Request $request, $id)
    {
        $resultResponse = new ResultResponse();
    
        try {
            $empleado = Empleado::findOrFail($id);
    
            $empleado->nombre = $request->input('nombre', $empleado->nombre);
            $empleado->apellidos = $request->input('apellidos', $empleado->apellidos);
            $empleado->ciudad = $request->input('ciudad', $empleado->ciudad);
            $empleado->pais = $request->input('pais', $empleado->pais);
            $empleado->imagen = $request->input('imagen', $empleado->imagen);
            $empleado->red_social = $request->input('red_social', $empleado->red_social); // Agregado el campo red_social
    
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

    public function buscar(Request $request)
    {
        $query = Empleado::query();

        if ($request->has('nombre')) {
            $query->where('nombre', 'like', '%' . $request->get('nombre') . '%');
        }

        if ($request->has('apellidos')) {
            $query->where('apellidos', 'like', '%' . $request->get('apellidos') . '%');
        }

        if ($request->has('ciudad')) {
            $query->where('ciudad', 'like', '%' . $request->get('ciudad') . '%');
        }

        if ($request->has('pais')) {
            $query->where('pais', 'like', '%' . $request->get('pais') . '%');
        }

        if ($request->has('red_social')) { // Filtro para red_social
            $query->where('red_social', 'like', '%' . $request->get('red_social') . '%');
        }

        $resultados = $query->paginate(10); 

        return response()->json($resultados);
    }

  
    /**
     * Validate the employee data before storing it in the database.
     */
    public function validateEmpleado($request)
    {
        $rules = [
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'ciudad' => 'required|string|max:40',
            'pais' => 'required|string|max:40',
            'imagen' => 'required|string',
            'red_social' => 'required|string', // Agregado el campo red_social
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