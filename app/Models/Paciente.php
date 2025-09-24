<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $primaryKey = 'id_paciente';
    protected $fillable = [
        'nombre',
        'especie',
        'raza',
        'edad',
        'nombre_duenio',
        'telefono_duenio',
        'fecha_registro'
    ];

    public $timestamps = true;

    public function tratamientos()
    {
        return $this->hasMany(Tratamiento::class, 'id_paciente');
    }
}



