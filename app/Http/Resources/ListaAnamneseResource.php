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
            'dono_id' => $this->pet->dono_id,
            'dono' => $this->pet->dono->nome,
            'petiente' => $this->pet->nome,
            'pet_id' => $this->pet->id,
            'motivo' => $this->motivo,
            'sintomas' => $this->sintomas,
            'cirurgias_ant' => $this->cirurgias_ant,
            'doencas_prev' => $this->doencas_prev,
            'med_em_uso' => $this->med_em_uso,
            'comport_pet' => $this->comport_pet != 0 ? 'Sim' : 'Não',
            'repro_recente' => $this->repro_recente != 0 ? 'Sim' : 'Não',
            'viagem' => $this->viagem,
        ];
    }
}
