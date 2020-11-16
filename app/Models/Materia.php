<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_str',
        'nombre',
        'departamento',
        'id_profesor',
        'id_asistente',
    ];

    public static function getID($strID)
    {
        if (self::where('id_str', '=', $strID)->exists()) {
            return self::where('id_str', '=', $strID)->first()->id;
        }
        return -1;
    }

    public function profesor()
    {
        return User::where('id', $this->id_profesor)->first();
    }

    public function asistente()
    {
        return $this->hasOne(User::class);
    }

    public function getCorrelativasFuertes()
    {
        return Materia::join('materia_correlativas', 'materia_correlativas.id_materia', '=', 'materias.id')
            ->select('mat.*')
            ->join('materias as mat', 'id_correlativa', '=', 'mat.id')
            ->where('materia_correlativas.tipo', '=', '1')
            ->where('id_materia', $this->id)
            ->get();
    }

    public function getCorrelativasDebiles()
    {
        return Materia::join('materia_correlativas', 'materia_correlativas.id_materia', '=', 'materias.id')
            ->select('mat.*')
            ->join('materias as mat', 'id_correlativa', '=', 'mat.id')
            ->where('materia_correlativas.tipo', '=', '0')
            ->where('id_materia', $this->id)
            ->get();
    }

    public function getMesasExamen()
    {
        return $this->hasMany(MesaExamen::class);
    }

    public function getAnio()
    {
        $materias_carreras = MateriasCarreras::join('materias', 'materias.id', '=', 'materias_carreras.id_materia')
            ->join('carreras', 'carreras.id', '=', 'materias_carreras.id_carrera')
            ->where('materias_carreras.id_materia', $this->id)
            ->select('materias_carreras.*')
            ->first();
        return $materias_carreras['anio'];
    }

    public function getCuatrimestre()
    {
        $materias_carreras = MateriasCarreras::join('materias', 'materias.id', '=', 'materias_carreras.id_materia')
            ->join('carreras', 'carreras.id', '=', 'materias_carreras.id_carrera')
            ->where('materias_carreras.id_materia', $this->id)
            ->select('materias_carreras.*')
            ->first();
        return $materias_carreras['cuatrimestre'];
    }

    public function asociadaACarrera()
    {
        return MateriasCarreras::where('materias_carreras.id_materia', '=', $this->id)->exists();
    }

}
