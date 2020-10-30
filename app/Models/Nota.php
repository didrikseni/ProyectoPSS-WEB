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


}