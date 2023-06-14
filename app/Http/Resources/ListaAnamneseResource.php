<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ListaAnamneseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'pet' => new PetienteResource($this->pet),
            'motivoDaConsulta' => $this->motivo,
            'sintomas' => $this->sintomas,
            'cirurgias' => $this->cirurgias_ant,
            'doencas' => $this->doencas_prev,
            'medicamentos' => $this->med_em_uso,
            'comportamento' => $this->comport_pet,
            'reproducao' => $this->repro_recente,
            'viagem' => $this->viagem,
            'dataCriacao' => date('d/m', strtotime($this->created_at)),
        ];
    }
}
