<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Elève extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nom', 'prénom', 'sexe', 'date_de_naissance', 'niveau_scolaire', 'parent_id',
    ];

    protected $table = 'elèves';
    public $timestamps = false;
    protected $primarykey = 'id_elève';

    public function elèveparent(){
        return $this->belongsTo('App\Elèveparent', 'parent_id');
    }
}
