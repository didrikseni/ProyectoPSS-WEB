<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscriptoEnCarrera extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_alumno',
        'id_carrera',
    ];

    public function alumno() {
        return $this->belongsTo(User::class);
    }

    public function carrera() {
        return $this->belongsTo(Carreras::class);
    }
}
