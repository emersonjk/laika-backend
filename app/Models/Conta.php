<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conta extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'anamnese_id',
        'doenca',
        'percentual',
    ];

    public function anamnese()
    {
        return $this->belongsTo(Anamnese::class, 'anamnese_id');
    }
}
