<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anamnese extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'pet_id',
        'motivo',
        'sintomas',
        'cirurgias_ant',
        'doencas_prev',
        'med_em_uso',
        'comport_pet',
        'repro_recente',
        'viagem',
    ];

    public function pet()
    {
        return $this->belongsTo(Petiente::class,'pet_id');
    }

    public function conta()
    {
        return $this->hasMany(Conta::class,'anamnese_id');
    }
}
