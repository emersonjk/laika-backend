<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteListaResource extends JsonResource
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
            'nome_tutor'=> $this->nome_tutor,
            'cpf_tutor' => $this->cpf_tutor,
            'email_tutor' => $this->email_tutor,
            'telefone_tutor' => $this->telefone_tutor,
            'cidade' => $this->cidade,
            'cep' => $this->cep,
            'casa' => $this->casa,
            'pet' => $this->pet != null ? PetienteResource::collection([$this->pet]) : 'sem pet cadastrado',
        ];
    }
}
