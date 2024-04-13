<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\OfreceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(TiendaController::class)->prefix('tiendas')->group(function () {

    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}','update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'delete');
    Route::post('/buscar', 'buscar');
    
});

Route::controller(ServicioController::class)->prefix('servicios')->group(function () {

    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}','update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'delete');
    Route::delete('/{servicioId}/empleados/{empleadoId}', 'deleteEmpleadosQuePrestanServicio');
    Route::get('/{servicioId}/empleados', 'listarEmpleadosDeServicio');
    Route::post('/{servicioId}/empleados/{empleadoId}', 'agregarEmpleado');
    Route::get('/{servicioId}/citas', 'citasDelServicio');

});

Route::controller(UsuarioController::class)->prefix('usuarios')->group(function () {

    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}','update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'delete');
    Route::get('/dni/{dni}', 'getByDni');
    
});

Route::controller(EmpleadoController::class)->prefix('empleados')->group(function () {

    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}','update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'delete');
    Route::get('/{empleado}/servicios', 'obtenerServicios');
    Route::delete('/{empleado}/servicios/{servicio}', 'eliminarServicio');
    Route::get('/buscar', 'buscar');
    
});

Route::controller(CitasController::class)->prefix('citas')->group(function () {

    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}','update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'delete');
    Route::get('/{cita}/servicios', 'obtenerServiciosDeCita');
    Route::delete('/{cita}/servicios/{servicio}', 'eliminarServicioDeCita');
    Route::post('/{citaId}/servicios/{servicioId}', 'asignarServicioACita');
    Route::get('/empleado/{idEmpleado}', 'obtenerCitasPorEmpleado');
    Route::get('/usuario/{dni}', 'obtenerCitasPorDniUsuario');

});

Route::controller(PrestaController::class)->prefix('presta')->group(function () { 

    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}','update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'delete');
    
});

Route::controller(OfreceController::class)->prefix('ofrece')->group(function () { 

    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}','update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'delete');
    
});