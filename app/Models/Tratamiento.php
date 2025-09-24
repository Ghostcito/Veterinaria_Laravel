<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    protected $primaryKey = 'id_tratamiento';
    protected $fillable = [
        'id_paciente',
        'descripcion',
        'fecha',
        'veterinario',
        'costo'
    ];

    public $timestamps = true;

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }

}
