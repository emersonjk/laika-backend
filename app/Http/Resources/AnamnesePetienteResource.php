<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnamnesePetienteResource extends JsonResource
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
            'nome' => $this->nome,
            'raca' => $this->raca,
            'especie' => $this->especies,
            'porte' => $this->porte,
            'sexo' => $this->sexo,
            'data de nascimento' => date('d/m/Y', strtotime($this->nascimento)),
            'dono' => ClienteResource::collection([$this->dono]),
        ];
    }
}
