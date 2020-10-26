<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Employe;
use App\Fiche_personnelle;

class GestionCompteAdminController extends Controller
{
    public function __construct(){
        $this->middleware('super_user');
    }

    public function index(){
        return view('Auth\employe\admin\super_user\gestion_admin');
    }

    public function getListeAdmins(){
        $admins = Employe::where('admin', '=', '1')->get();
        return view('Auth\employe\admin\super_user\comptes_admins', compact('admins'));
    }

    public function getFichesAdmins(){
        $personnels = Employe::where('admin', '=', '1')->get();
        return view('Auth\employe\admin\super_user\fiches_admins', compact('personnels'));
    }

    public function getPageModifierAdmin($admin_id){
        $personnel = Employe::find($admin_id);
        return view('Auth\employe\admin\super_user\form_modifier_admin', compact('personnel'));
    }

    public function supprimerAdmin($admin_id){
        $admin = Employe::find($admin_id);
        $admin->fiche_personnelle()->delete();
        $admin->delete();

        return redirect()->route('admins.comptes_admins')->with('success', 'Compte admin supprimé avec succés');
    }

    public function getPageAjouterAdmin(){
        return view('Auth\employe\admin\super_user\form_ajouter_admin');
    }

    public function ajouterAdmin(Request $request){
        $validation = $this->validator($request->all(), ['required', 'email:dns', 'max:255', 'unique:employes'], ['required', 'string', 'confirmed','min:8', 'max:10']); 

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $this->createPersonnel($request->all());
        return redirect()->route('admins.comptes_admins')->with('success', 'Compte admin ajouté avec succés');
    }

    public function modifierAdmin(Request $request, $admin_id){
        if(strlen($request->all()['password']) == 0){
            $validation = $this->validator($request->all(), ['required', 'email:dns', 'max:255', 'exists:employes'], []);
        }else {
            $validation = $this->validator($request->all(), ['required', 'email:dns', 'max:255', 'exists:employes'],['required','string', 'confirmed','min:8', 'max:10']);
        }

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $this->updatePersonnel($request->all(), $admin_id);
        return redirect()->route('admins.comptes_admins')->with('success', 'Compte admin modifié avec succés');
    }

    public function validator(array $data, $email_rule, $rule){
        return Validator::make($data, [
            'nom' => ['required', 'string', 'max:255'],
            'prénom' => ['required', 'string', 'max:255'],
            'sexe' => ['required', 'string', 'max:2', 'min:1'], 
            'date_de_naissance' => ['required', 'string', 'max:255'], 
            'fonction' => ['required', 'string', 'max:255', 'min:4'], 
            'email' => $email_rule, 
            'password' => $rule, 
            'adresse' => ['required', 'string', 'max:255'], 
            'tel' => ['required', 'string', 'digits:10'],
        ]);
    }

    protected function createPersonnel(array $data){
        $personnel = Employe::create([
            'nom' => $data['nom'], 
            'prénom' => $data['prénom'], 
            'sexe' => $data['sexe'], 
            'date_de_naissance' => $data['date_de_naissance'], 
            'fonction' => $data['fonction'], 
            'email' => $data['email'], 
            'password' => Hash::make($data['password']),
            'adresse' => $data['adresse'], 
            'tel' => $data['tel'],
            'admin' => 1,
            'personnel' => 0,
            'enseignant' => 0,
        ]);
        \App\Fiche_personnelle::create([
            'nationalité' => '',
            'num_carte_sejour' => '', 
            'num_carte_travail' => '', 
            'situation_familiale' => '', 
            'num_sécurité_sociale' => '', 
            'code_postale' => '', 
            'ville' => '', 
            'qualification' => '', 
            'contrat' => '', 
            'durée' => '', 
            'salaire_mensuel' => 0.0, 
            'date_entrée' => 0, 
            'date_sortie' => 0, 
            'situation_avant_enbauche' => '', 
            'employe_id' => $personnel->id,
        ]);
    }

    protected function updatePersonnel(array $data, $personnel_id){
        $personnel = Employe::find($personnel_id);

        $personnel->nom = $data['nom'];
        $personnel->prénom = $data['prénom'];
        $personnel->sexe = $data['sexe'];
        $personnel->date_de_naissance = $data['date_de_naissance'];
        $personnel->fonction = $data['fonction'];
        $personnel->email = $data['email'];

        if(strlen($data['password']) > 0){
            $personnel->password = Hash::make($data['password']);    
        }

        $personnel->adresse = $data['adresse'];
        $personnel->tel = $data['tel'];

        $personnel->save();
    }

    // méthode de gestion des fiches personnelles des admins
    public function getFichesAdmin(){
        $personnels = Employe::select("*")->where('admin', '=','1')->get();
        $fiches = array();
        foreach($personnels as $p){
            array_push($fiches, $p->fiche_personnelle);
        }
        return view('Auth\employe\admin\super_user\fiches_admins', compact('fiches'));
    }

    public function getFichePersonnelle($fiche_id){
        $f_p = Fiche_personnelle::find($fiche_id);
        return view('Auth\employe\admin\super_user\fiche_personnelle', compact('f_p'));
    }

    public function pageModifierFicheAdmin($fiche_id){
        $fiche = \App\Fiche_personnelle::find($fiche_id);
        return view('Auth\employe\admin\super_user\form_modifier_fiche', compact('fiche'));
    }

    public function modifier_fiche(Request $request, $fiche_id){
        $fiche = \App\Fiche_personnelle::find($fiche_id);
        $valid = $this->validator_fiche($request->all());

        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $this->update($request->all(), $fiche->id, $fiche->employe->id);

        return redirect()->route('admins.gestion_fiches_admins')->with('success', 'Fiche modifiée avec succés');
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

    public function validator_fiche(array $data){
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
}
