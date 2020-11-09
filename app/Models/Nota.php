<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = [
        'calificacion',
        'LU_alumno',
        'id_mesa_examen',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mesaExamen() {
        return $this->hasOne(MesaExamen::class);
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
