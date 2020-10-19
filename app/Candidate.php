<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Candidate extends Model
{
    use Notifiable;

    protected $fillable = ['desc', 'poll_id'];

    public $timestamps = false;

    public function poll(){
        return $this->belongsTo('App\Poll', 'poll_id');
    }
}
