<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Article extends Model
{
    use Notifiable;

    protected $fillable = [
        'type','titre', 'image', 'objet', 'texte', 'employe_id',
    ];

    protected $table = 'articles';

    public function employe(){
        return $this->belongsTo('App\Employe', 'employe_id');
    }
}
