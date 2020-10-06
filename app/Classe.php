<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Classe extends Model
{
    use Notifiable;
    
    protected $fillable = [
        'nom_classe', 'limite',
    ];

    protected $table = 'classes';
    public $timestamps = false;

    public function elèves(){
        return $this->hasMany('App\Elève');
    }

    public function employes(){
        return $this->belongsToMany('App\Employe', 'classe_employe');
    }

    public function cahier_textes(){
        return $this->hasMany('App\Cahier_texte');
    }
}
