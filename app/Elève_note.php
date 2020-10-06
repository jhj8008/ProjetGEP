<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elève_note extends Model
{
    protected $fillable = [
        'elève_id', 'elève_nom', 'matière_id', 'matière_nom', 'note', 'remarque',
    ];
}
