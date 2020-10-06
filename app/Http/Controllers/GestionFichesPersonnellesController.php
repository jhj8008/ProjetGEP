<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GestionFichesPersonnellesController extends Controller
{
    public function __construct(){
        $this->middleware('personnel');
    }

    public function index(){
        $emp = \App\Employe::select("*")->where('enseignant', '1')->get();
        $f_p = array();
        foreach($emp as $e){
            array_push($f_p, $e->fiche_personnelle);
        }
        return view('Auth\employe\personnel\fichesPersonnelles', compact('f_p'));
    }

    public function getFichePersonnelle($f_p_id){
        $f_p = \App\Fiche_personnelle::find($f_p_id);
        return view('Auth\employe\personnel\fiche_personnelle');
    }
}
