<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $valeur;
    protected $remarque;

    public function __construct($v, $r){
        $this->valeur = $v;
        $this->remarque = $r;
    }

    // getters + setters
}
