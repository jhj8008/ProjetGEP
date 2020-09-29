<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Negligence extends Model
{
    use Notifiable;

    protected $fillable = [
        'date', 'durée', 'raison', 'période', 'type', 'employe_id', 'elève_id','matière_id',
    ];

    protected $table = 'negligences';
    public $timestamps = false;

    public function elève(){
        return $this->belongsTo('App\Elève', 'elève_id');
    }

    public function employe(){
        return $this->belongsTo('App\Employe', 'employe_id');
    }

    public function matière(){
        return $this->belongsTo('App\Matière', 'matière_id');
    }
}
