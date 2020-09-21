<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employe extends Authenticatable
{
    use Notifiable;

    protected $guard = 'employe';

    protected $fillable = [
        'nom', 'prénom', 'sexe', 'date_de_naissance', 'fonction', 'email', 'password', 'adresse', 'tel', 'admin','personnel','enseignant',
    ];

    protected $table = 'employes';
    public $timestamps = false;
}
