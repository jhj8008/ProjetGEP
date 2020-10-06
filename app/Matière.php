<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Matière extends Model
{
    use Notifiable;

    protected $fillable = [
        'nom','description','coefficient','nbr_heures',
    ];

    protected $table = 'matières';
    public $timestamps = false;

    public function employes(){
        return $this->belongsToMany('App\Employe', 'employe_matière');
    }

    public function negligences(){
        return $this->hasMany('App\Negligence');
    }

    public function notes(){
        return $this->hasMany('App\Note');
    }

    public function cahier_textes(){
        return $this->hasMany('App\Cahier_texte');
    }
}
