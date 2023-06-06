<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClienteListaResource;
use App\Http\Resources\ClienteResource;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientesController extends Controller
{
    public function index()
    {
        try {

            $clientes = Cliente::with('pet')->get();

            if (is_object($clientes)) {
                return response()->json([
                    'error' => false,
                    'message' => 'Sem erros',
                    'results' => ['Clientes' => ClienteListaResource::collection($clientes)],
                ], 200);
            }else{
                return response()->json([
                    'error' => false,
                    'message' => 'Sem erros',
                    'results' => ['Clientes' => '0 Clientes Cadastrados'],
                ], 200);
            }

        }catch(\Throwable $th){
            Log::error($th);
            dd($th);
            return response()->json([
                'error' => true,
                'message' => 'Erro ao listar os Clientes!',
                'erro_results' => $th->getMessage(),
            ], 500);
        }
    }

    public function detalhe($id)
    {

        try {

            $cliente = Cliente::with('pet')->where('id',$id)->get();

            return response()->json([
                'error' => false,
                'message' => 'Sem erros',
                'results' => ['Cliente' => ClienteListaResource::collection($cliente)],
            ], 200);

        }catch (\Throwable $th){
            Log::error($th);
            dd($th);
            return response()->json([
                'error' => true,
                'message' => 'Erro ao listar os Clientes!',
                'erro_results' => $th->getMessage(),
            ], 500);
        }
    }

    public function cadastra(Request $request)
    {
        $input = $request->all();

        dd($request,$input);
    }
}
