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
$cliente_controller = ClientesController::class;
Route::get('users',[$cliente_controller, 'index'])->name('index'); // pega todos os clientes
Route::post('users',[$cliente_controller, 'cadastra'])->name('cadastra'); // Cadastra os clientes
Route::get('/users/{id}',[$cliente_controller, 'detalhe'])->name('detalhe'); // Detalhe de cliente
Route::get('/users/delete/{id}',[$cliente_controller, 'delete'])->name('delete'); // deleta cliente e pet
// Route::post('/anamneses/pets/{pet_id}/anamneses',[$cliente_controller, 'cadastra'])->name('cadastra');

//Anamnese
$anamneseController = AnamneseController::class;
Route::get('/anamneses/pets/{petId}/anamneses',[$anamneseController, 'index'])->name('index'); //lista anamneses de 1 pets
Route::post('/anamneses/pets/{petId}',[$anamneseController, 'cadastra'])->name('cadastra'); // Cadastra as anamneses
Route::get('/anamneses/anamneses',[$anamneseController, 'lista'])->name('lista'); // lista todas as anamneses



//Petientes
/*Route::prefix('pet')->name('clientes.')->group(function () {
    $api_controller = PetienteController::class;
    Route::get('-lista',[$api_controller, 'index'])->name('index');
    Route::get('/{id}',[$api_controller, 'detalhe'])->name('detalhe');
    Route::post('cadastro',[$api_controller, 'cadastra'])->name('cadastra');
});*/
