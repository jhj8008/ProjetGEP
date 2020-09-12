<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sondage extends Model
{
    protected $titre;
    protected $resultat;

    public function __construct($t){
        $this->titre = $t;
    }

    // getters + setters
}
