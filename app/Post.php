<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class Post extends Model
{
    use Notifiable;

    protected $fillable = [
        'titre', 'description', 'employe_id', 'elèveparent_id', 'created_at',
    ];

    protected $table = 'posts';

    public function employe(){
        return $this->belongsTo('App\Employe', 'employe_id');
    }

    public function elèveparent(){
        return $this->belongsTo('App\Elèveparent', 'elèveparent_id');
    }

    public function getPostAgeInDays(){
        $current_date = Carbon::now();
        $creation_date = Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at);

        return $creation_date->diffInDays($current_date);
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }
}
