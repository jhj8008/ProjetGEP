<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Comment extends Model
{
    use Notifiable;

    protected $fillable = [
        'description', 'post_id', 'employe_id', 'elèveparent_id',
    ];

    protected $table = 'comments';

    public function post(){
        return $this->belongsTo('App\Post', 'post_id');
    }

    public function elèveparent(){
        return $this->belongsTo('App\Elèveparent', 'elèveparent_id');
    }

    public function employe(){
        return $this->belongsTo('App\Employe', 'employe_id');
    }
}
