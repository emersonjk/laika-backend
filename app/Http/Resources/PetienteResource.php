<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PetienteResource extends JsonResource
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
            'cliente_id' => $this->cliente_id,
            'nome_pet' => $this->nome_pet,
            'idade_pet' => $this->idade_pet,
            'peso' => $this->peso,
            'especie' => $this->especie,
            'raca' => $this->raca,
            'sexo' => $this->sexo,
        ];
    }
}
