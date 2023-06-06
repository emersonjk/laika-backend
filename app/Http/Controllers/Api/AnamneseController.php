<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AnamneseResource;
use App\Http\Resources\ListaAnamneseResource;
use App\Models\Anamnese;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AnamneseController extends Controller
{
    public function index($id)
    {
        try {

            $anamneses = Anamnese::where('pet_id',$id)->with('pet.cliente')->get();

            dd($anamneses, 'comportamento: [\'estressado\',\'Nucio\']');
            if (is_object($anamneses)) {
                return response()->json([
                    'error' => false,
                    'message' => 'Sem erros',
                    'results' => ['anamneses' => ListaAnamneseResource::collection($anamneses)],
                ], 200);
            }else{
                return response()->json([
                    'error' => false,
                    'message' => 'Sem erros',
                    'results' => ['anamneses' => 'Sem Anamneses Anteriores'],
                ], 200);
            }

        }catch(\Throwable $th){
            Log::error($th);
            dd($th);
            return response()->json([
                'error' => true,
                'message' => 'Erro ao listar as anamneses!',
                'erro_results' => $th->getMessage(),
            ], 500);
        }
    }

    public function detalhe($id)
    {

        try {

            $anamnese = Anamnese::where('id',$id)->get();

            return response()->json([
                'error' => false,
                'message' => 'Sem erros',
                'results' => ['anamnese' => AnamneseResource::collection($anamnese)],
            ], 200);

        }catch (\Throwable $th){
            Log::error($th);
            dd($th);
            return response()->json([
                'error' => true,
                'message' => 'Erro ao listar a anamnese!',
                'erro_results' => $th->getMessage(),
            ], 500);
        }
    }

    public function cadastra(Request $request)
    {
        $input = $request->all();
        dd($request,$input);
        try {

        }catch (\Throwable $th){

        }
    }

    public function edita(Request $request)
    {
        try {

        }catch (\Throwable $th){

        }
    }

    public function update(Request $request)
    {
        try {

        }catch (\Throwable $th){

        }
    }

    public function delete(Request $request)
    {
        try {

        }catch (\Throwable $th){

        }
    }
}
