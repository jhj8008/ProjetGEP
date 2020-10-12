<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NegligenceEmploye extends Model
{
    protected $fillable = [
        'date', 'durée', 'raison', 'période', 'type', 'employe_id',
    ];

    protected $table = "negligenceemployes";

    public function employe(){
        return $this->belongsTo('App\Employe', 'employe_id');
    }
}
