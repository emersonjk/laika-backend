<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AnamneseResource;
use App\Http\Resources\ListaAnamneseResource;
use App\Models\Anamnese;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AnamneseController extends Controller
{
    public function index($petId)
    {
        try {

            $anamneses = Anamnese::where('pet_id',$petId)->with('pet')->get();

            if (is_object($anamneses)) {
                return response()->json(
                    ListaAnamneseResource::collection($anamneses)
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

    public function lista()
    {

        try {

            $anamneses = Anamnese::with('pet')->get();

            if (is_object($anamneses)) {
                return response()->json(
                    ListaAnamneseResource::collection($anamneses)
                    , 200);
            }else{
                return response()->json(
                    []
                    ,200
                );
            }

        }catch (\Throwable $th){
            Log::error($th);
            return response()->json(
                $th->getMessage()
                ,  500);
        }
    }

    public function cadastra(Request $request,$petId)
    {
        $input =[
            'pet_id' => $petId,
            'motivo' => $request['motivoDaConsulta'],
            'sintomas' => $request['sintomas'],
            'cirurgias_ant' => $request['cirurgias'],
            'doencas_prev' => $request['doencas'],
            'med_em_uso' => $request['medicamentos'],
            'comport_pet' => $request['comportamento'],
            'repro_recente' => $request['reproducao'],
            'viagem' => $request['viagem'],
        ];

        DB::beginTransaction();

        try {

            $id = Anamnese::create($input);

            $anamnese = Anamnese::with('pet')->where('id',$id->id)->first();

            DB::commit();

            return response()->json(
                new ListaAnamneseResource($anamnese)
                , 200);

        }catch (\Throwable $th){
            Log::error($th);
            DB::rollBack();
            dd($th);
            return response()->json(
                $th->getMessage()
                ,  500);
        }
    }

    /*public function delete(Request $request)
    {
        try {

        }catch (\Throwable $th){

        }
    }*/
}
