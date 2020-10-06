<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Elève;
use \App\Elèveparent;

class GestionInfoElèveController extends Controller
{
    public function __construct(){
        $this->middleware('personnel');
    }

    public function index(){
        $élèves = \App\Elève::all();
        return view('Auth\employe\personnel\gestion_élèves', compact('élèves'));
    }

    public function getProfileElève($élève_id){
        $élève = \App\Elève::find($élève_id);
        $info_parent = $élève->elèveparent;
        return view('Auth\employe\personnel\profile_élève', compact(['élève', 'info_parent']));
    }

    public function getFormModification($élève_id){
        $élève = \App\Elève::find($élève_id);
        $info_parent = $élève->elèveparent;
        $parent_id = $info_parent->id; 
        $classes = \App\Classe::all();
        return view('Auth\employe\personnel\form_profile_élève', compact(['élève', 'info_parent', 'parent_id', 'classes', 'élève_id']));
    }

    public function modifierProfile(Request $request, $élève_id, $parent_id){
        $validation = $this->validator($request->all());
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $this->update($request->all(), $élève_id, $parent_id);
        return redirect()->route('personnels.liste_élèves')->with('success', 'Profile élève modifié avec succés');
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'nom' => ['required', 'string', 'max:255'], 
            'prénom' => ['required', 'string', 'max:255'], 
            'sexe' => ['required', 'string'], 
            'date_de_naissance' => ['required', 'string', 'date_format:Y-m-d'], 
            'niveau_scolaire' => ['required', 'string'], 
            'classe' => ['required', 'string'],
            'nom_père' => ['required', 'string', 'max:255'], 
            'nom_mère' => ['required', 'string', 'max:255'], 
            'fonction_père' => ['required', 'string', 'max:255'], 
            'fonction_mère' => ['required', 'string', 'max:255'], 
            'tel' => ['required', 'digits:10'], 
            'email' => ['required', 'email:dns', 'exists:elèveparents'],
        ]);
    }

    protected function update(array $data, $élève_id, $parent_id) {
        $élève = Elève::find($élève_id);
        $élève->nom = $data['nom'];
        $élève->prénom = $data['prénom'];
        $élève->sexe = $data['sexe'];
        $élève->date_de_naissance = date('Y-m-d',strtotime($data['date_de_naissance']));
        $élève->niveau_scolaire = $data['niveau_scolaire'];
        // chercher la classe_id 
        $classe = \App\Classe::select("*")->where('nom_classe', 'like', $data['classe'])->first();
        $élève->classe_id = $classe->id;
        $élève->save();

        $elève_parent = Elèveparent::find($parent_id);
        $elève_parent->nom_père = $data['nom_père'];
        $elève_parent->nom_mère = $data['nom_mère'];
        $elève_parent->fonction_père = $data['fonction_père'];
        $elève_parent->fonction_mère = $data['fonction_mère'];
        $elève_parent->tel = $data['tel'];
        $elève_parent->email = $data['email'];
        $elève_parent->save();
    }

    public function supprimerProfileElève($élève_id){
        $élève = \App\Elève::find($élève_id);
        $élève->negligences()->delete();
        $élève->notes()->delete();
        $élève->delete();
        return redirect()->route('personnels.liste_élèves');
    }
}
