<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GestionCahierTexteController extends Controller
{
    public function __construct(){
        $this->middleware('enseignant');
    }

    public function index(){
        return view('Auth\employe\enseignant\cahier_texte');
    }

    public function getListeClasses($matId){
        $classes = Auth::guard('employe')->user()->classes;
        return view('Auth\employe\enseignant\liste_classes_cahier', compact(['classes', 'matId']));
    }

    public function getCahierTexte($matId, $classe_id){
        $cahier_texte = \App\Cahier_texte::select("*")->where('matière_id', '=', $matId)->where('classe_id', '=', $classe_id)->where('employe_id', '=', Auth::guard('employe')->user()->id)->get();
        $matière = \App\Matière::find($matId);
        return view('Auth\employe\enseignant\liste_taches_cahier', compact(['matId', 'classe_id', 'cahier_texte', 'matière']));
    }

    public function supprimerTache($matId, $classe_id, $tache_id){
        $tache_ct = \App\Cahier_texte::find($tache_id);
        $tache_ct->delete();
        return redirect()->back()->with('success', 'Ligne supprimée avec succès');
    }

    public function ouvrirTache($matId, $classe_id, $tache_id){
        $tache_ct = \App\Cahier_texte::find($tache_id);
        return view('Auth\employe\enseignant\modifier_tache_cahier', compact(['matId', 'classe_id', 'tache_ct', 'tache_id']));
    }

    public function modifierTache(Request $request, $matId, $classe_id, $tache_id){
        $validation = $this->validator($request->all());
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $this->updateTache($request->all(), $tache_id);
        return redirect()->route('enseignants.page_cahier_de_texte', ['matId' => $matId, 'id' => $classe_id]);
    }

    public function ouvrirFormTache($matId, $classe_id){
        /*$tache_ct = \App\Cahier_texte::find($tache_id);*/
        return view('Auth\employe\enseignant\créer_tache_cahier', compact(['matId', 'classe_id']));
    }

    public function ajouterTache(Request $request, $matId, $classe_id){
        $validation = $this->validator($request->all());
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $this->create($request->all(), $matId, $classe_id);
        return redirect()->route('enseignants.page_cahier_de_texte', ['matId' => $matId, 'id' => $classe_id]);
    }

    protected function create(array $data, $matière_id, $classe_id){
        $classe = \App\Classe::find($classe_id);
        $niveau_scolaire = $classe->elèves->first()->niveau_scolaire;
        return \App\Cahier_texte::create([
            'date_publication' => $data['date'],
            'a_faire' => $data['a_faire'],
            'fait' => $data['fait'],
            'cours' => $data['cours'],
            'niveau_scolaire' => $niveau_scolaire,
            'employe_id' => Auth::guard('employe')->user()->id,
            'classe_id' => $classe_id,
            'matière_id' => $matière_id,
        ]);
    }

    protected function validator(array $data){
        $messages = [
            'required' => ':attribute est obligatoire dans ce formulaire',
            'string' => ':attribute doit être une chaîne de caractères',
            'max' => 'la taille max de :attribute ne doit pas dépasser :max caractères',
            'date' => ':attribute doit être de type date'
        ];
        return Validator::make($data, [
            'date' => ['required', 'date', 'date_format:Y-m-d'],
            'a_faire' => ['required', 'string', 'max:255'],
            'fait' => ['required', 'string', 'max:255'],
            'cours' => ['required', 'string', 'max:255'],
        ], $messages);
    }

    public function updateTache(array $data, $tache_id){
        $tache_ct = \App\Cahier_texte::find($tache_id);
        $tache_ct->date_publication = $data['date'];
        $tache_ct->a_faire = $data['a_faire'];
        $tache_ct->fait = $data['fait'];
        $tache_ct->cours = $data['cours'];

        $tache_ct->save();
    }
}
