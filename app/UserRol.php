<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRol extends Model
{
    protected $table = 'UsersRols';

    protected $primarykey = 'id';
    
    protected $fillable = ['idUsers', 'idRol'];

    public function Rol()
    {
        return $this->belongsTo('App\Rol', 'id', 'idRol');
    }

    public function User()
    {
        return $this->belongsTo('App\User', 'id ', 'idUsers');
    }
}
