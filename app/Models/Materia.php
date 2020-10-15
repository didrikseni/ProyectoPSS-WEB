<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Materia extends Model
{
    use HasFactory;

    public function profesor()
    {
        return $this->hasOne(User::class);
    }

    public function asistente()
    {
        return $this->hasOne(User::class);
    }
}
