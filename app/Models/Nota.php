<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = [
        'calificacionFinal',
        'calificacionCursada',
        'LU_alumno',
        'id_mesa_examen',
        'id_materia',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mesaExamen() {
        return $this->hasOne(MesaExamen::class);
    }

    public function esFinal() {
        return $this->id_materia == null;
    }

    public function esCursada() {
        return $this->id_mesa_examen == null;
    }

    public function gradingType(){
        return [
            'Parcial',
            'Final'
        ];
    }
    public function gradingResult(){
        return [
            'Aprobado',
            'Desaprobado'
        ];
    }

    public function gradingNumResult($N){
        $toRet = array();
        for ($i = 1; $i <= $N; $i++){
            array_push($toRet, $i);
        }
        return $toRet;
    }



}
