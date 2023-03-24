<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $table = 'DocumentsTypes';
    
    protected $primarykey = 'id';

    protected $fillable = ['name'];

    public function User()
    {
        return $this->hasMany('App\User', 'idDocumentsTypes', 'id');
    }
}
