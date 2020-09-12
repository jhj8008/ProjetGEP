<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choix extends Model
{
    protected $nom;

    public function __construct($n){
        $this->nom = $n;
    }

    // getters + setters
}
