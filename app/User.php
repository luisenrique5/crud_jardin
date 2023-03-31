<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';

    protected $primarykey = 'id';


    protected $fillable = [
       'document', 'nickname', 'email', 'password','idDocumentsTypes',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function documentType()
    {
        return $this->belongsTo('App\DocumentType', 'idDocumentsTypes', 'id');
    }

    public function userRol()
    {
        return $this->hasMany('App\UserRol', 'idUsers', 'id');
    }

    public function rols()
    {
        return $this->belongsToMany('App\Rol', 'UsersRols', 'idUsers', 'idRol');
    }
}
