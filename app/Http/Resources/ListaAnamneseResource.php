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
            'cliente' => ClienteResource::collection($this->pet->cliente),
            'pet' => PetienteResource::collection($this->pet),
            'pet_id' => $this->pet->id,
            'motivo' => $this->motivo,
            'sintomas' => $this->sintomas,
            'cirurgias_ant' => $this->cirurgias_ant,
            'doencas_prev' => $this->doencas_prev,
            'med_em_uso' => $this->med_em_uso,
            'comport_pet' => $this->comport_pet,
            'repro_recente' => $this->repro_recente,
            'viagem' => $this->viagem,
        ];
    }
}
