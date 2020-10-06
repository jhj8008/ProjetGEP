<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cahier_texte extends Model
{
    use Notifiable;

    protected $fillable = [
        'date_publication', 'a_faire', 'fait', 'cours', 'niveau_scolaire', 'employe_id', 'classe_id', 'matière_id',
    ];

    protected $table = 'cahier_textes';

    public function employe(){
        return $this->belongsTo('App\Employe', 'employe_id');
    }

    public function classe(){
        return $this->belongsTo('App\Classe', 'classe_id');
    }

    public function matière(){
        return $this->belongsTo('App\Matière', 'matière_id');
    }
}
