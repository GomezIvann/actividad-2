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
        $usuarios = Usuario::all();
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
                'nombre_usuario' => $request->input('nombre_usuario'),
                'nombre_completo' => $request->input('nombre_completo'),
                'genero' => $request->input('genero'),
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
            $usuario->nombre_usuario = $request->input('nombre_usuario');
            $usuario->nombre_completo = $request->input('nombre_completo');
            $usuario->genero = $request->input('genero');
            $usuario->direccion = $request->input('direccion');
            $usuario->ciudad = $request->input('ciudad');
            $usuario->pais = $request->input('pais');
            $usuario->correo = $request->input('correo');
            $usuario->contraseña = $request->input('contraseña');
            $usuario->telefono = $request->input('telefono');

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

    public function put(Request $request, $id)
    {
        $resultResponse = new ResultResponse();

        try {
            $usuario = Usuario::findOrFail($id);

            $usuario->nombre_usuario = $request->input('nombre_usuario', $usuario->nombre_usuario);
            $usuario->nombre_completo = $request->input('nombre_completo', $usuario->nombre_completo);
            $usuario->genero = $request->input('genero', $usuario->genero);
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

    /**
     * Validate the user data before storing it in the database.
     */
    public function validateUsuario($request)
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
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errorMessage = implode(', ', $errors);
            throw new \Exception($errorMessage);
        }
    }
}
