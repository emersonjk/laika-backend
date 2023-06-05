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
    public function index()
    {
        try {

            $anamneses = Anamnese::with('pet.dono')->get();

            return response()->json([
                'error' => false,
                'message' => 'Sem erros',
                'results' => ['atendimentos' => ListaAnamneseResource::collection($anamneses)],
            ], 200);

        }catch(\Throwable $th){
            Log::error($th);
            dd($th);
            return response()->json([
                'error' => true,
                'message' => 'Erro ao listar os atedimentos!',
                'erro_results' => $th->getMessage(),
            ], 500);
        }
    }

    public function detalhe(Request $request)
    {
        $input = $request->except('_token');

        try {

            $anamnese = Anamnese::where('id',$input['id'])->get();

            return response()->json([
                'error' => false,
                'message' => 'Sem erros',
                'results' => ['atendimento' => AnamneseResource::collection($anamnese)],
            ], 200);

        }catch (\Throwable $th){
            Log::error($th);
            dd($th);
            return response()->json([
                'error' => true,
                'message' => 'Erro ao listar o atedimento!',
                'erro_results' => $th->getMessage(),
            ], 500);
        }
    }

    public function cadastra(Request $request)
    {
        dd($request);
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
