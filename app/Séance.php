<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Séance extends Model
{
    use Notifiable;

    protected $fillable = [
        'jour', 'heure_début', 'heure_fin', 'description', 'employe_id', 'matière_id',
    ];

    protected $table = 'séances';

    public function matière(){
        return $this->belongsTo('App\Matière', 'matière_id');
    }

    public function emploi_temps(){
        return $this->belongsToMany('App\Emploi_temp', 'emploi_temp_séance');
    }

    public function employe(){
        return $this->belongsTo('App\Employe', 'employe_id');
    }
}
