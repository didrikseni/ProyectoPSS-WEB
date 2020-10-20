<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materia_correlativa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_materia',
        'id_correlativa',
        'tipo',
    ];

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    public function correlativa()
    {
        return $this->belongsTo(Materia::class);
    }

}
