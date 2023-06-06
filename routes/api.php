<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AnamneseController;
use App\Http\Controllers\Api\ClientesController;
use App\Http\Controllers\Api\PetienteController;

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


//Clientes
Route::prefix('cliente')->name('clientes.')->group(function () {
    $api_controller = ClientesController::class;
    Route::get('',[$api_controller, 'index'])->name('index'); // listar os clientes
    Route::get('/{id}',[$api_controller, 'detalhe'])->name('detalhe'); // Detalhe dos clientes
    Route::post('/cadastro',[$api_controller, 'cadastra'])->name('cadastra');

    //Anamnese
    Route::prefix('/anamnese')->name('anamnese.')->group(function () {
        $api_controller = AnamneseController::class;
        Route::get('/{id}',[$api_controller, 'index'])->name('index'); //lista as anamneses
        Route::post('/{id}/cadastra',[$api_controller, 'cadastra'])->name('cadastra'); // Cadastra as anamneses
        Route::get('/{id}/detalhe',[$api_controller, 'detalhe'])->name('detalhe'); // abre a anamnese
    });
});

//Petientes
/*Route::prefix('pet')->name('clientes.')->group(function () {
    $api_controller = PetienteController::class;
    Route::get('-lista',[$api_controller, 'index'])->name('index');
    Route::get('/{id}',[$api_controller, 'detalhe'])->name('detalhe');
    Route::post('cadastro',[$api_controller, 'cadastra'])->name('cadastra');
});*/
