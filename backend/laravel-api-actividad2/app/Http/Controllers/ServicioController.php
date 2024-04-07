<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Libs\ResultResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicios = Servicio::all();
        $resultResponse = new ResultResponse();
        $resultResponse->setData($servicios);
        $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
        $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);

        return response()->json($resultResponse);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateServicio($request);
    
        $resultResponse = new ResultResponse();
    
        try {
            $nuevoServicio = new Servicio([
                'descripcion' => $request->input('descripcion'),
                'puntos' => $request->input('puntos'),
                'nombre' => $request->input('nombre'),
                'precio' => $request->input('precio'),
            ]);
    
            $nuevoServicio->save();
    
            $resultResponse->setData($nuevoServicio);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
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
            //$servicio = Servicio::with('empleados')->where('codigo', $id)->firstOrFail();
            $servicio = Servicio::where('codigo', $id)->firstOrFail();
            $resultResponse->setData($servicio);
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
        $this->validateServicio($request);
        $resultResponse = new ResultResponse();
    
        try {
            $servicio = Servicio::findOrFail($id);
            $servicio->descripcion = $request->get('descripcion');
            $servicio->puntos = $request->get('puntos');
            $servicio->nombre = $request->get('nombre');
            $servicio->precio = $request->get('precio');
    
            $servicio->save();
    
            $resultResponse->setData($servicio);
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
            $servicio = Servicio::where('codigo', $id)->firstOrFail();

            $servicio->descripcion = $request->input('descripcion', $servicio->descripcion);
            $servicio->puntos = $request->input('puntos', $servicio->puntos);
            $servicio->nombre = $request->input('nombre', $servicio->nombre);
            $servicio->precio = $request->input('precio', $servicio->precio);

            $servicio->save();

            $resultResponse->setData($servicio);
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
           

            $servicio = Servicio::where('codigo', $id)->firstOrFail();
            $servicio->delete();

            $resultResponse->setData($servicio);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch (\Exception $e) {
    
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setMessage("Error al eliminar el servicio: " . $e->getMessage());
        }

        return response()->json($resultResponse);
    }

    
    public function validateServicio($request)
    {
        $rules = [
            'descripcion' => 'required|string',
            'puntos' => 'required|integer|min:0',
            'nombre' => 'required|string',
            'precio' => 'required|numeric|min:0',
        ];

        $messages = [
            'descripcion.required' => 'La descripción es obligatoria.',
            'puntos.required' => 'Los puntos son obligatorios.',
            'puntos.integer' => 'Los puntos deben ser un número entero.',
            'puntos.min' => 'Los puntos deben ser como mínimo :min.',
            'nombre.required' => 'El nombre es obligatorio.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un valor numérico.',
            'precio.min' => 'El precio debe ser como mínimo :min.',
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errorMessage = implode(', ', $errors);
            throw new \Exception($errorMessage);
        }
    }

    public function deleteEmpleadosQuePrestanServicio($servicioId, $empleadoId)
    {
        $resultResponse = new ResultResponse();

        try {
            // Buscar el servicio
            $servicio = Servicio::findOrFail($servicioId);

            // Eliminar la relación entre el empleado y el servicio
            $servicio->empleados()->detach($empleadoId);

            $resultResponse->setData($servicio);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage('Empleado eliminado que presta el servicio correctamente');
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage('Error al eliminar el empleado que presta el servicio: ' . $e->getMessage());
        }

        return response()->json($resultResponse);
    }


}
