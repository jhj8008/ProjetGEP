<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fiche_personnelle extends Model
{
    protected $fillable = [
        'nationalité','num_carte_sejour', 'num_carte_travail', 'situation_familiale', 'num_sécurité_sociale', 'code_postale', 'ville', 'qualification', 'contrat', 'durée', 'salaire_mensuel', 'date_entrée', 'date_sortie', 'situation_avant_enbauche', 'employe_id',
    ];

    protected $table = 'fiche_personnelles';

    public function employe(){
        return $this->belongsTo('App\Employe', 'employe_id');
    }
}
