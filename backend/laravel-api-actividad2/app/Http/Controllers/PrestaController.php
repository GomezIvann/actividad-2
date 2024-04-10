<?php

namespace App\Http\Controllers;

use App\Models\Presta;
use App\Libs\ResultResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrestaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prestas = Presta::paginate(10);
        $resultResponse = new ResultResponse();
        $resultResponse->setData($prestas);
        $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
        $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);

        return response()->json($resultResponse);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validatePresta($request);

        $resultResponse = new ResultResponse();

        try {
            $presta = new Presta([
                'codigo_servicio' => $request->get('codigo_servicio'),
                'id_empleado' => $request->get('id_empleado'),
            ]);

            $presta->save();

            $resultResponse->setData($presta);
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
    public function show($codigo_servicio, $id_empleado)
    {
        $resultResponse = new ResultResponse();

        try {
            $presta = Presta::where('codigo_servicio', $codigo_servicio)
                            ->where('id_empleado', $id_empleado)
                            ->firstOrFail();

            $resultResponse->setData($presta);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
        }

        return response()->json($resultResponse);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $codigo_servicio, $id_empleado)
    {
        $this->validatePresta($request);

        $resultResponse = new ResultResponse();

        try {
            $presta = Presta::where('codigo_servicio', $codigo_servicio)
                            ->where('id_empleado', $id_empleado)
                            ->firstOrFail();

            $presta->update([
                'codigo_servicio' => $request->get('codigo_servicio'),
                'id_empleado' => $request->get('id_empleado'),
            ]);

            $resultResponse->setData($presta);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
        }

        return response()->json($resultResponse);
    }

        /**
     * Update the specified resource in storage.
     */
    public function put(Request $request, $codigo_servicio, $id_empleado)
    {
        $resultResponse = new ResultResponse();

        try {
            $presta = Presta::where('codigo_servicio', $codigo_servicio)
                            ->where('id_empleado', $id_empleado)
                            ->firstOrFail();

            $presta->update([
                'codigo_servicio' => $request->input('codigo_servicio', $presta->codigo_servicio),
                'id_empleado' => $request->input('id_empleado', $presta->id_empleado),
            ]);

            $resultResponse->setData($presta);
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
    public function delete($codigo_servicio, $id_empleado)
    {
        $resultResponse = new ResultResponse();

        try {
            $presta = Presta::where('codigo_servicio', $codigo_servicio)
                            ->where('id_empleado', $id_empleado)
                            ->firstOrFail();

            $presta->delete();

            $resultResponse->setData($presta);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch (\Exception $e) {
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
        }

        return response()->json($resultResponse);
    }

    /**
     * Validate the specified resource before storing.
     */
    public function validatePresta($request)
    {
        $rules = [
            'codigo_servicio' => 'required|integer',
            'id_empleado' => 'required|integer',
        ];

        $messages = [
            'codigo_servicio.required' => 'El código de servicio es obligatorio.',
            'codigo_servicio.integer' => 'El código de servicio debe ser un número entero.',
            'id_empleado.required' => 'El ID del empleado es obligatorio.',
            'id_empleado.integer' => 'El ID del empleado debe ser un número entero.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errorMessage = implode(', ', $errors);
            throw new \Exception($errorMessage);
        }
    }
}
