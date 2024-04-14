<?php

namespace App\Http\Controllers;

use App\Models\Ofrece;
use App\Libs\ResultResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfreceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ofrece = Ofrece::paginate(10);
        $resultResponse = new ResultResponse();
        $resultResponse->setData($ofrece);
        $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
        $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);

        return response()->json($resultResponse);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateOfrece($request);

        $resultResponse = new ResultResponse();

        try {
            $ofrece = new Ofrece([
                'codigo_servicio' => $request->get('codigo_servicio'),
                'id_cita' => $request->get('id_cita'),
            ]);

            $ofrece->save();

            $resultResponse->setData($ofrece);
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
    public function show($codigo_servicio, $id_cita)
    {
        $resultResponse = new ResultResponse();

        try {
            $ofrece = Ofrece::where('codigo_servicio', $codigo_servicio)
                            ->where('id_cita', $id_cita)
                            ->firstOrFail();

            $resultResponse->setData($ofrece);
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
        $this->validateOfrece($request);
        $resultResponse = new ResultResponse();

        try {
            $ofrece = Ofrece::findOrFail($id);
            $ofrece->codigo_servicio = $request->input('codigo_servicio');
            $ofrece->id_cita = $request->input('id_cita');

            $ofrece->save();

            $resultResponse->setData($ofrece);
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
            $ofrece = Ofrece::findOrFail($id);

            $ofrece->codigo_servicio = $request->input('codigo_servicio', $ofrece->codigo_servicio);
            $ofrece->id_cita = $request->input('id_cita', $ofrece->id_cita);

            $ofrece->save();

            $resultResponse->setData($ofrece);
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
    public function delete($codigo_servicio, $id_cita)
    {
        $resultResponse = new ResultResponse();

        try {
            $ofrece = Ofrece::where('codigo_servicio', $codigo_servicio)
                            ->where('id_cita', $id_cita)
                            ->firstOrFail();

            $ofrece->delete();

            $resultResponse->setData($ofrece);
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
    public function validateOfrece($request)
    {
        $rules = [
            'codigo_servicio' => 'required|integer',
            'id_cita' => 'required|integer',
        ];

        $messages = [
            'codigo_servicio.required' => 'El código de servicio es obligatorio.',
            'codigo_servicio.integer' => 'El código de servicio debe ser un número entero.',
            'id_cita.required' => 'El ID de la cita es obligatorio.',
            'id_cita.integer' => 'El ID de la cita debe ser un número entero.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errorMessage = implode(', ', $errors);
            throw new \Exception($errorMessage);
        }
    }
}
