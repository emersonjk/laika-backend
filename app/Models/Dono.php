<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dono extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nome',
        'telefone',
        'cpf',
        'email',
    ];

    public function pets()
    {
        return $this->hasMany(Petiente::class, 'dono_id');
    }
}
