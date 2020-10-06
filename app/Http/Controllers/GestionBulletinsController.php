<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;

class GestionBulletinsController extends Controller
{

    public function __construct(){
        $this->middleware('enseignant');
    }

    public function index(){
        return view('Auth\employe\enseignant\bulletins');
    }

    public function getListeClasse($classe_id){
        $classe = \App\Classe::find($classe_id);
        $élèves = $classe->elèves;
        return view('Auth\employe\enseignant\liste_classe', compact(['classe_id', 'élèves']));
    }

    public function generatePDF($classe_id, $élève_id){
        $élève = \App\Elève::find($élève_id);
        $nbr_retard = 0;
        $nbr_absence = 0; 
        $classe = \App\Classe::find($classe_id);
        $nbr_élève = count($classe->elèves);
        foreach($élève->negligences as $neg){
            if($neg->type == 'retard'){
                $nbr_retard++;
            }else{
                $nbr_absence++;
            }
        }
        $notes = \App\Note::select("*")->where('elève_id', '=', $élève_id)->orderBy('matière_id')->get();

        $coef_note = array();
        $sum_coef = 0;
        foreach($notes as $n){
            $coef_note[$n->id] = (($n->valeur + $n->valeur2) / 2.0) * $n->matière->coefficient;
            $sum_coef += $n->matière->coefficient;
        }

        $sum_coef_note = round(array_sum($coef_note), 2);
        $moyenne = round($sum_coef_note / $sum_coef, 2);

        $date = date('Y-m-d');
        $pdf = PDF::loadView('Auth\employe\enseignant\page_bulletin_élève', compact(['classe_id', 'élève', 'nbr_retard', 'nbr_absence', 'nbr_élève', 'notes', 'coef_note', 'sum_coef', 'sum_coef_note', 'moyenne', 'date']))->setPaper([0, 0, 705.98, 596.85], 'landscape');
        $pdf->save(storage_path().'_bulletin_test_' . $élève_id . '.pdf');
        return $pdf->download('_bulletin_test_' . $élève_id . '.pdf');
        /*$elève_id = $élève_id;
        return view('Auth\employe\enseignant\page_bulletin_élève', compact(['classe_id', 'elève_id', 'élève', 'nbr_retard', 'nbr_absence', 'nbr_élève', 'notes', 'coef_note', 'sum_coef', 'sum_coef_note', 'moyenne', 'date']));*/
    }

    /*public function generatePDF($classe_id, $élève_id, $nbr_retard, $nbr_absence, $nbr_élève,$sum_coef, $sum_coef_note, $moyenne, $date){
        // reste: notes, élève, coef_note
        $élève = \App\Elève::find($élève_id);
        $notes = \App\Note::select("*")->where('elève_id', '=', $élève_id)->orderBy('matière_id')->get();
        foreach($notes as $n){
            $coef_note[$n->id] = (($n->valeur + $n->valeur2) / 2.0) * $n->matière->coefficient;
        }

        $pdf = PDF::loadView('Auth\employe\enseignant\page_bulletin_élève', compact(['classe_id', 'élève', 'nbr_retard', 'nbr_absence', 'nbr_élève', 'notes', 'coef_note', 'sum_coef', 'sum_coef_note', 'moyenne', 'date', 'data_array']));
        $pdf->save(storage_path().'_bulletin_' . $élève_id . '.pdf');
        return $pdf->download('_bulletin_' . $élève_id . '.pdf');
    }*/
}
