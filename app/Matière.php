<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matière extends Model
{
    protected $nom;
    protected $description;
    protected $coefficient;
    protected $nbr_heures;

    public function __construct($n, $desc, $coeff, $nh){
        $this->nom = $nom;
        $this->description = $desc;
        $this->coefficient = $coeff;
        $this->nbr_heures = $nh;
    }

    // getters + setters
}
