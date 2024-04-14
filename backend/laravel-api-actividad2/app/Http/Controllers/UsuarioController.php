<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Libs\ResultResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::paginate(10);
        $resultResponse = new ResultResponse();
        $resultResponse->setData($usuarios);
        $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
        $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);

        return response()->json($resultResponse);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateUsuario($request);

        $resultResponse = new ResultResponse();

        try {
            $nuevoUsuario = new Usuario([
                'dni' => $request->input('dni'),
                'nombre' => $request->input('nombre'),
                'apellido' => $request->input('apellido'),
                'direccion' => $request->input('direccion'),
                'ciudad' => $request->input('ciudad'),
                'pais' => $request->input('pais'),
                'correo' => $request->input('correo'),
                'contraseña' => $request->input('contraseña'),
                'telefono' => $request->input('telefono'),
            ]);

            $nuevoUsuario->save();

            $resultResponse->setData($nuevoUsuario);

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
            $usuario = Usuario::findOrFail($id);
            $resultResponse->setData($usuario);
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
        $this->validateUsuario($request);
        $resultResponse = new ResultResponse();

        try {
            $usuario = Usuario::findOrFail($id);
            $usuario->dni = $request->input('dni', $usuario->dni);
            $usuario->nombre = $request->input('nombre', $usuario->nombre);
            $usuario->apellido = $request->input('apellido', $usuario->apellido);
            $usuario->direccion = $request->input('direccion', $usuario->direccion);
            $usuario->ciudad = $request->input('ciudad', $usuario->ciudad);
            $usuario->pais = $request->input('pais', $usuario->pais);
            $usuario->correo = $request->input('correo', $usuario->correo);
            $usuario->contraseña = $request->input('contraseña', $usuario->contraseña);
            $usuario->telefono = $request->input('telefono', $usuario->telefono);

            $usuario->save();

            $resultResponse->setData($usuario);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);  
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage($e->getMessage());
        }

        return response()->json($resultResponse);
    }

    public function patch(Request $request, $id)
    {
        $resultResponse = new ResultResponse();

        try {
            $usuario = Usuario::findOrFail($id);

            $usuario->dni = $request->input('dni', $usuario->dni);
            $usuario->nombre = $request->input('nombre', $usuario->nombre);
            $usuario->apellido = $request->input('apellido', $usuario->apellido);
            $usuario->direccion = $request->input('direccion', $usuario->direccion);
            $usuario->ciudad = $request->input('ciudad', $usuario->ciudad);
            $usuario->pais = $request->input('pais', $usuario->pais);
            $usuario->correo = $request->input('correo', $usuario->correo);
            $usuario->contraseña = $request->input('contraseña', $usuario->contraseña);
            $usuario->telefono = $request->input('telefono', $usuario->telefono);

            $usuario->save();

            $resultResponse->setData($usuario);
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
            $usuario = Usuario::findOrFail($id);
            $usuario->delete();

            $resultResponse->setData($usuario);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
        }

        return response()->json($resultResponse);
    }

    public function getByDni($dni)
    {
        $resultResponse = new ResultResponse();

        try {
            $usuario = Usuario::where('dni', $dni)->first();

            if (!$usuario) {
                throw new \Exception('Usuario no encontrado.');
            }

            $resultResponse->setData($usuario);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setMessage($e->getMessage());
        }

        return response()->json($resultResponse);
    }

    public function buscar(Request $request)
    {
        $resultResponse = new ResultResponse();

        try {
            $query = Usuario::query();

            if ($request->has('dni')) {
                $query->where('dni', 'like', '%' . $request->input('dni') . '%');
            }

            if ($request->has('nombre')) {
                $query->where('nombre', 'like', '%' . $request->input('nombre') . '%');
            }

            if ($request->has('apellido')) {
                $query->where('apellido', 'like', '%' . $request->input('apellido') . '%');
            }

            if ($request->has('correo')) {
                $query->where('correo', 'like', '%' . $request->input('correo') . '%');
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
     * Validate the user data before storing it in the database.
     */
    public function validateUsuario($request)
    {
        $rules = [
            'dni' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
            'correo' => 'required|string|max:255',
            'contraseña' => 'required|string|max:255',
            'telefono' => 'required|integer',
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errorMessage = implode(', ', $errors);
            throw new \Exception($errorMessage);
        }
    }
}
