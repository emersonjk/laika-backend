<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anamnese;
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

                dd($response, $anamnese);
                return $response;
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
}
