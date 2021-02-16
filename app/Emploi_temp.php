<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Emploi_temp extends Model
{
    use Notifiable;

    protected $fillable = [
        'remarque', 'année_scolaire', 'classe_id',
    ];

    protected $table = 'emploi_temps';

    public function classe(){
        return $this->belongsTo('App\Classe', 'classe_id');
    }

    public function séances(){
        return $this->belongsToMany('App\Séance', 'emploi_temp_séance')->orderBy('heure_début');
    }
}
