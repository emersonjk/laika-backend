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
            'nome' => $this->nome,
            'idade' => $this->idade,
            'peso' => $this->peso,
            'especie' => $this->especie,
            'raca' => $this->raca,
            'sexo' => $this->sexo,
        ];
    }
}
