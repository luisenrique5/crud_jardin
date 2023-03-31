<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'Rols';

    protected $primarykey = 'id';
    
    protected $fillable = ['name'];

    public function userRol()
    {
        return $this->hasMany('App\UserRol', 'idRol', 'id');
    }

    public function user()
    {
        return $this->belongsToMany('App\User', 'UsersRols','idRol','idUsers');
    }
}
