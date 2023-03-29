<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'Rols';

    protected $primarykey = 'id';
    
    protected $fillable = ['name'];

    public function UserRol()
    {
        return $this->hasMany('App\UserRol', 'idRol', 'id');
    }

    public function User ()
    {
        return $this->belongsToMany('App\User ', 'UsersRols', 'idUsers', 'idRol');
    }
}
