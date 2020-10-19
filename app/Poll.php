<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Poll extends Model
{
    use Notifiable;

    protected $fillable = [
        'desc', 'deadline',
    ];

    protected $table = 'polls';

    public function candidates(){
        return $this->hasMany('App\Candidate');
    }

    public function employes(){
        return $this->belongsToMany('App\Employe', 'poll_user');
    }

}
