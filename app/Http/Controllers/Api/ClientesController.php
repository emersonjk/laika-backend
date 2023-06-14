<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClienteListaResource;
use App\Http\Resources\ClienteResource;
use App\Models\Cliente;
use App\Models\Petiente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClientesController extends Controller
{
    public function index()
    {
        try {

            $clientes = Cliente::with('pet')->get();

            if (is_object($clientes)) {
                return response()->json(
                    ClienteListaResource::collection($clientes)
                    , 200);
            }else{
                return response()->json(
                    []
                    ,200
                );
            }

        }catch(\Throwable $th){
            Log::error($th);
            return response()->json(
                $th->getMessage()
                ,  500);
        }
    }
    public function cadastra(Request $request)
    {

        $input = $request->all();

        DB::beginTransaction();
        try {
            $usuario = [
                "nome" => $input["nome"],
                "email" => $input["email"],
                "telefone" => $input["telefone"],
                "cidade" => $input["cidade"],
                "cep" => $input["cep"],
                "cpf" => $input["cpf"],
                "casa" => $input["casa"]
            ];

            $pet = $input["pet"];

            $id = Cliente::create($usuario);
            $pet['cliente_id'] = $id->id;

            Petiente::create($pet);

            DB::commit();

            $cliente = Cliente::with('pet')->where('id',$id->id)->get();
            return response()->json(
                ClienteListaResource::collection($cliente)
                , 200);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(
                $th->getMessage()
                , 500);
        }

    }

    public function detalhe($id)
    {

        try {

            $cliente = Cliente::with('pet')->where('id',$id)->get();

            return response()->json(
                ClienteListaResource::collection($cliente)
                , 200);

        }catch (\Throwable $th){
            Log::error($th);
            return response()->json(
                $th->getMessage()
                , 500);
        }
    }

    public function delete($id)
    {

        $clientes = Cliente::with('pet')->where('id',$id)->get();
        try {

            $clientes[0]->pet->delete();
            $clientes[0]->delete();

            return response()->json('Excluído com sucesso', 200);

        }catch (\Throwable $th){
            Log::error($th);
            return response()->json(
                $th->getMessage()
                , 500);
        }
    }

}
