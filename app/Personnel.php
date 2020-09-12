<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Personnel extends Authenticatable
{

    use Notifiable;

    protected $fillable = [
        'nom', 'prénom', 'date_de_naissance', 'fonction', 'adresse', 'email', 'password', 'tel'
    ];

    protected $table = 'personnels';
    public $timestamps = false;
    protected $primarykey = 'id_personnel';
}
