<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nome_tutor',
        'cpf_tutor',
        'email_tutor',
        'telefone_tutor',
        'cidade',
        'cep',
        'casa'
    ];

    public function pet()
    {
        return $this->hasOne(Petiente::class, 'cliente_id');
    }
}
