<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Petiente extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'dono_id',
        'nome',
        'raca',
        'especies',
        'porte',
        'sexo',
        'nascimento',
    ];

    public function anamnese()
    {
        return $this->hasMany(Anamnese::class,'pet_id');
    }

    public function dono()
    {
        return $this->belongsTo(Dono::class, 'dono_id');
    }

}
