<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AnamneseController;

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

//Anamnese
Route::prefix('anamnese')->name('anamnese.')->group(function () {
    $api_controller = AnamneseController::class;
    Route::get('',[$api_controller, 'index'])->name('index');
    Route::post('detalhe',[$api_controller, 'detalhe'])->name('detalhe');
    Route::post('cadastra',[$api_controller, 'cadastra'])->name('cadastra');
});
