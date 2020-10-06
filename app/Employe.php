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

    public function matières(){
        return $this->belongsToMany('App\Matière', 'employe_matière');
    }

    public function classes(){
        return $this->belongsToMany('App\Classe', 'classe_employe');
    }

    public function negligences(){
        return $this->hasMany('App\Negligence');
    }

    public function cahier_textes(){
        return $this->hasMany('App\Cahier_texte');
    }

    public function fiche_personnelle(){
        return $this->hasOne('App\Fiche_personnelle');
    }
}
