<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class Elèveparent extends Authenticatable
{
    use Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom_père', 'nom_mère', 'fonction_père', 'fonction_mère', 'tel', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //protected $table = 'elèveparents';
    public $timestamps = false;
    protected $primarykey = 'id';

    public function elèves(){
        return $this->hasMany('App\Elève');
    }
}
