<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reçu extends Model
{
    protected $date_de_paiement;
    protected $montant;
    protected $méthode_paiement;

    public function __construct($dp, $m, $mp){
        $this->date_de_paiement = $dp;
        $this->montant = $m;
        $this->méthode_paiement = $mp;
    }

    // getters + setters
}
