<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Elève;
use DateTime;

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
        /*$élèves = Elève::where('parent_id', '=', Auth::user()->id)->get();*/
        $classes = \App\Classe::all();
        return view('emplois_du_temps', compact('classes'));
    }

    public function getEmploiTemps($classe_id){
        /*$élève = Elève::find($élève_id);
        $emploi_id = $élève->classe->emploi_temp;*/

        $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'];
        //return view('emploi_temps', compact('jours', 'emploi_id'));
        
        // new code 13/11/2020
        $classe = \App\Classe::find($classe_id);
        $edt = $classe->emploi_temp;
        /*$t_séances = $edt->séances;*/
        $séances = $edt->séances;
        /*foreach($t_séances as $s){
            if($s->jour == $jour){
                array_push($séances, $s);
            }
        }*/
        $date_emploi = Carbon::parse($edt->created_at)->format('d-m-Y');
        $tmp = new DateTime($date_emploi);
        $semaine = $tmp->format("W");

        /*echo $semaine;*/

        /*return view('page_edt', compact(['edt', 'séances', 'date_emploi', 'semaine', 'jours']));*/
        return view('edt_vertical', compact(['edt', 'séances', 'date_emploi', 'semaine', 'jours']));
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
