<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscription_pedagogique extends Model
{
    //
    protected $table='inscription_pedagogiques';
    protected $primaryKey = 'id_etudiant';
    public $timestamps = false;
}
