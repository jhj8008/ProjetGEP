<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Elève;

class EmploiTempsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $élèves = Elève::where('parent_id', '=', Auth::user()->id)->get();
        return view('emplois_du_temps', compact('élèves'));
    }

    public function getEmploiTemps($élève_id){
        $élève = Elève::find($élève_id);
        $emploi_id = $élève->classe->emploi_temp->id;

        $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'];
        return view('emploi_temps', compact('jours', 'emploi_id'));
    }

    public function getSéances($emploi_id, $jour){
        $edt = \App\Emploi_temp::find($emploi_id);
        $t_séances = $edt->séances;
        $séances = [];
        foreach($t_séances as $s){
            if($s->jour == $jour){
                array_push($séances, $s);
            }
        }

        return view('séance_jour', compact(['séances', 'jour']));
    }
}
