<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Elève extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nom', 'prénom', 'sexe', 'date_de_naissance', 'niveau_scolaire', 'parent_id', 'classe_id',
    ];

    protected $table = 'elèves';
    public $timestamps = false;
    protected $primarykey = 'id_elève';

    public function elèveparent(){
        return $this->belongsTo('App\Elèveparent', 'parent_id');
    }

    public function classe(){
        return $this->belongsTo('App\Classe', 'classe_id');
    }

    public function negligences(){
        return $this->hasMany('App\Negligence');
    }

    public function notes(){
        return $this->hasMany('App\Note');
    }
}
