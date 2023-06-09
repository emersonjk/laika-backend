<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ListaAnamneseResource;
use App\Models\Anamnese;
use App\Models\Conta;
use App\Models\Especie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContaController extends Controller
{
    public function conta($anamneseId)
    {
        try {
            $anamnese = Anamnese::where('id', $anamneseId)->first();

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

                $conta = Conta::where("anamnese_id", $anamnese->id)->get();
                if (is_object($conta)){
                    foreach ($conta as $cont) {
                        $cont->delete();
                    }
                }
                $arrayContas = (array)$contas;
                arsort($arrayContas);
                $primeirosValores = array_slice($arrayContas, 0, 3, true);


                foreach ($primeirosValores as $key => $percentual){
                    Conta::create(array(
                        'anamnese_id' => $anamnese->id,
                        'doenca' => $key,
                        'percentual' => $percentual,
                    ));
                }

                $anamnese->with('conta');

                Log::debug($anamnese->sintomas);
                Log::debug($response);
                Log::debug($anamnese->conta);


            return response()->json(
                new ListaAnamneseResource($anamnese)
                , 200);

            }else{
                return response()->json(
                    ['error' => 'Anamnese não encontrada']
                    ,200
                );
            }

        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(
                $th->getMessage()
                ,  500);
        }
    }

    public function especies()
    {
        try {
            $cats = Especie::where("tipo","gato")->orderBy('raca', 'asc')->pluck('raca');
            $dogs = Especie::where("tipo","cao")->orderBy('raca', 'asc')->pluck('raca');

            $data = [
                'gato' => $cats,
                'cao' => $dogs,
            ];

            return response()->json($data, 200);

        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(
                $th->getMessage()
                ,  500);
        }
    }
}
