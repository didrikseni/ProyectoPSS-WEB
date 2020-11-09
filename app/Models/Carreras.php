<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carreras extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'anio_inicio',
        'id_str',
        'departamento_responsable',
        'profesor_responsable',
    ];

    public static function getID($strID)
    {
        if (self::where('id_str', '=', $strID)->exists()) {
            return self::where('id_str', '=', $strID)->first()->id;
        }
        return -1;
    }

    public function materias() {
        return self::select('materias.*')
            ->join('materias_carreras', 'materias_carreras.id_carrera', '=', 'carreras.id')
            ->join('materias', 'materias.id', '=', 'materias_carreras.id_materia')
            ->where('carreras.id', $this->id)
            ->get();
    }

}
