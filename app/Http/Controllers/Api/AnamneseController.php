<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AnamneseResource;
use App\Http\Resources\ListaAnamneseResource;
use App\Models\Anamnese;
use App\Models\Conta;
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

            if (is_object($anamnese)) {
                $metodo = 'post';
                $endpoint = 'http://3.216.56.94/api/data';
                $headers = ['Content-Type: application/json'];
                $postFields = ['sintomas' => $anamnese->sintomas];

                $curl = curl_init();
                curl_setopt_array($curl, array(
                        CURLOPT_URL => $endpoint,
                        CURLOPT_HTTPHEADER => $headers,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_POST => true,
                        CURLOPT_CUSTOMREQUEST => strtoupper($metodo),
                        CURLOPT_POSTFIELDS => json_encode($postFields))
                );

                $response = curl_exec($curl);
                curl_close($curl);

                $contas = json_decode($response);

                foreach ($contas as $key => $percentual){
                    Conta::create(array(
                        'anamnese_id' => $anamnese->id,
                        'doenca' => $key,
                        'percentual' => $percentual,
                    ));
                }

                $anamnese->with('conta');

            }

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

    public function detalhe($anamneseId)
    {
        try {
            $anamnese = Anamnese::where('id', $anamneseId)->first();

            if (is_object($anamnese)) {
                return response()->json(
                    new ListaAnamneseResource($anamnese)
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
}
