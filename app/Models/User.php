<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'DNI',
        'fecha_nacimiento',
        'lugar_nacimiento',
        'direccion_calle',
        'direccion_numero',
        'escuela_secundaria',
        'numero_telefono',
        'legajo',
        'rol',
        'password',
        'nombre_usuario'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getUserName($name, $surname){
        $first_name_letter = $name[0];
        $int = 0;
        $userName = strtolower( $first_name_letter . $surname);

        $already_exist = User::where('nombre_usuario' , $userName)->first();

        while ($already_exist != null){
            $int++; 
            $already_exist = User::where('nombre_usuario', $userName . $int)->first();                           
        }
        if($int != 0){
            $userName = $userName. $int;
        }
        $userName = str_replace(' ', '', $userName);
        return $userName; 
    }

    public static function getLegajo(){
        if (User::count()<1){
            $legajo = 0;
        }
        else {
            $user_max_legajo = User::max('legajo');
            $legajo = $user_max_legajo + 1;
        }        
        return $legajo;
    }

    public function roleOptions(){
        return[
            'Alumno',
            'Profesor',
            'Administrador'
        ];
    }

    public function isAdmin(){
        return $this->rol == 'Administrador';
    }

    public function isProfessor(){
        return $this->rol == 'Profesor';
    }

    public function isStudent(){
        return $this->rol == 'Alumno';
    }

}
