<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\Empleado;
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
        $servicios = Servicio::paginate(10);
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
    
    public function patch(Request $request, $id)
    {
        $resultResponse = new ResultResponse();

        try {
            $servicio = Servicio::where('codigo', $id)->firstOrFail();

            $servicio->descripcion = $request->input('descripcion', $servicio->descripcion);
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
            'nombre' => 'required|string',
            'precio' => 'required|numeric|min:0',
        ];

        $messages = [
            'descripcion.required' => 'La descripción es obligatoria.',
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

        /**
     * Listar los empleados de un servicio.
     */
    public function listarEmpleadosDeServicio($servicioId)
    {
        $resultResponse = new ResultResponse();

        try {
            // Buscar el servicio por su ID
            $servicio = Servicio::findOrFail($servicioId);

            // Obtener los empleados asociados al servicio
            $empleados = $servicio->empleados;

            // Establecer los datos de respuesta
            $resultResponse->setData($empleados);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage('Empleados asociados al servicio obtenidos correctamente');
        } catch (\Exception $e) {
            // Manejar errores
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage('Error al obtener los empleados asociados al servicio: ' . $e->getMessage());
        }

        // Devolver respuesta JSON
        return response()->json($resultResponse);
    }

    /**
     * Agrega un empleado al servicio especificado.
     */
    public function agregarEmpleado(Request $request, $servicioId, $empleadoId)
    {
        $resultResponse = new ResultResponse();

        try {
            // Buscar el servicio
            $servicio = Servicio::findOrFail($servicioId);

            // Verificar si el empleado ya está asociado al servicio
            if ($servicio->empleados()->where('id', $empleadoId)->exists()) {
                throw new \Exception('El empleado ya está asociado a este servicio.');
            }

            // Buscar el empleado
            $empleado = Empleado::findOrFail($empleadoId);

            // Asociar el empleado al servicio
            $servicio->empleados()->attach($empleadoId);

            $resultResponse->setData($servicio);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage('Empleado agregado al servicio correctamente.');
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage('Error al agregar el empleado al servicio: ' . $e->getMessage());
        }

        return response()->json($resultResponse);
    }

    public function citasDelServicio($servicioId)
    {
        $resultResponse = new ResultResponse();

        try {
            $servicio = Servicio::findOrFail($servicioId);
            $citasDelServicio = $servicio->citas()->get();
            
            $resultResponse->setData($citasDelServicio);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
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
            $query = Servicio::query();

            if ($request->has('descripcion')) {
                $query->where('descripcion', 'like', '%' . $request->input('descripcion') . '%');
            }

            if ($request->has('nombre')) {
                $query->where('nombre', 'like', '%' . $request->input('nombre') . '%');
            }

            if ($request->has('precio')) {
                $query->where('precio', 'like', '%' . $request->input('precio') . '%');
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
