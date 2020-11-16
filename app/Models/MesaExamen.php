<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MesaExamen extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'fecha',
        'horario',
        'tipo_examen',
        'observaciones',
        'id_materia'        
    ];

    public static function type_exam_options(){
        return[
            'Regular',
            'Libre',
        ];
    }

    public function notas(){
        return $this->hasMany(IncriptoEnMesaExamen::class,'id_mesa_examen');
    }

    public function materia(){
        return Materia::where('id', '=', $this->id_materia)->first();
    }



    
}

