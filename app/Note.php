<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $valeur;
    protected $remarque;

    protected $fillable = [
        'valeur', 'remarque', 'elève_id', 'matière_id','valeur2',
    ];

    protected $table = 'notes';
    public $timestamps = false;

    public function elève(){
        return $this->belongsTo('App\Elève', 'elève_id');
    }

    public function matière(){
        return $this->belongsTo('App\Matière', 'matière_id');
    }
}
