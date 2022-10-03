<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncidentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Este Middleware sobreescribe el header de Accept del Request para forzarlo a 'application/json'
Route::apiResource('incidents', IncidentController::class);

//Ruta por defecto en caso de no tener coincidencias.
Route::any('{any}', function(){
    return response()->json([
        'status'    => false,
        'message'   => 'The request could not be handled.',
    ], 404);
})->where('any', '.*');
