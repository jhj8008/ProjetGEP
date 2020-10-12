<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Fiche_personnelle;
use \App\Employe;

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
        return view('Auth\employe\personnel\fiche_personnelle', compact('f_p'));
    }

    public function pageFormModifierFiche($fiche_id){
        $fiche = \App\Fiche_personnelle::find($fiche_id);
        return view('Auth\employe\personnel\form_modifier_fiche', compact('fiche'));
    }

    public function modifierFiche(Request $request, $fiche_id){
        $fiche = \App\Fiche_personnelle::find($fiche_id);
        $valid = $this->validator($request->all());

        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $this->update($request->all(), $fiche->id, $fiche->employe->id);

        return redirect()->route('personnels.fiches_personnelles');
    }

    protected function update(array $data, $fiche_id, $emp_id){
        $fiche = \App\Fiche_personnelle::find($fiche_id);
        $emp = \App\Employe::find($emp_id);


        $fiche->nationalité = $data['nationalité'];
        $fiche->num_carte_sejour = $data['num_carte_sejour'];
        $fiche->num_carte_travail = $data['num_carte_travail'];
        $fiche->situation_familiale = $data['situation_familiale'];
        $fiche->num_sécurité_sociale = $data['num_sécurité_sociale'];
        $fiche->code_postale = $data['code_postale'];
        $fiche->ville = $data['ville'];
        $fiche->qualification = $data['qualification'];
        $fiche->contrat = $data['contrat'];

        if($data['contrat'] == 'CDI'){
            $fiche->durée = "-";
        }else {
            $fiche->durée = $data['durée'];
        }
        $fiche->salaire_mensuel = $data['salaire_mensuel'];
        $fiche->date_entrée = date('Y-m-d',strtotime($data['date_entrée']));
        $fiche->date_sortie = date('Y-m-d',strtotime($data['date_sortie']));
        $fiche->situation_avant_enbauche = $data['situation_avant_enbauche'];

        $emp->nom = $data['nom'];
        $emp->prénom = $data['prénom'];
        $emp->sexe = $data['sexe'];
        $emp->date_de_naissance = $data['date_de_naissance'];
        $emp->fonction = $data['fonction'];
        $emp->email = $data['email'];
        $emp->adresse = $data['adresse'];
        $emp->tel = $data['tel'];

        $fiche->save();
        $emp->save();
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'nom' => ['required', 'string', 'max:255'],
            'prénom' => ['required', 'string', 'max:255'],
            'sexe' => ['required', 'string', 'max:255'],
            'date_de_naissance' => ['required', 'string'],
            'ville' => ['required', 'string', 'max:255'],
            'nationalité' => ['required', 'string', 'max:255'],
            'num_carte_sejour' => ['required', 'string', 'digits:9'],
            'num_carte_travail' => ['required', 'string', 'digits:9'],
            'code_postale' => ['required', 'string', 'digits:5'],
            'situation_familiale' => ['required', 'string', 'max:255'],
            'num_sécurité_sociale' => ['required', 'string', 'digits:9'],
            'adresse' => ['required', 'string', 'max:255'],
            'tel' => ['required', 'string', 'digits:10'],
            'email' => ['required','email:dns', 'exists:employes'],
            'fonction' => ['required', 'string', 'max:255'],
            'qualification' => ['required', 'string', 'max:255'],
            'contrat' => ['required', 'string', 'max:255'],
            'durée' => ['string', 'integer', 'max:12'],
            'salaire_mensuel' => ['required', 'string'],
            'date_entrée' => ['required', 'string'],
            'date_sortie' => ['required', 'string'],
            'situation_avant_enbauche' => ['required', 'string', 'max:255'],
        ]);
    }

    public function supprimerFiche($fiche_id){
        $fiche = \App\Fiche_personnelle::find($fiche_id);
        $fiche->delete();

        return redirect()->route('personnels.fiches_personnlles')->with('success', 'Fiche personnelle supprimée avec succés !');
    }
}
