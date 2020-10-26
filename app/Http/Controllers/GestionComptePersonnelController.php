<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Employe;
class GestionComptePersonnelController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        return view('Auth\employe\admin\gestion_personnel');
    }

    public function getListePersonnels(){
        $personnels = Employe::where('personnel', '=', '1')->get();

        return view('Auth\employe\admin\comptes_personnels', compact('personnels'));
    }

    public function pageFormAjouterPersonnel(){
        return view('Auth\employe\admin\form_ajouter_personnel');
    }

    public function pageFormModifierPersonnel($personnel_id){
        $personnel = Employe::find($personnel_id);
        return view('Auth\employe\admin\form_modifier_personnel', compact('personnel'));
    }

    public function ajouterPersonnel(Request $request){
        $validation = $this->validator($request->all(), ['required', 'email:dns', 'max:255', 'unique:employes'], ['required', 'string', 'confirmed','min:8', 'max:10']); 

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $this->createPersonnel($request->all());

        return redirect()->route('admins.comptes_personnels');
    }

    public function modifierPersonnel(Request $request, $personnel_id){
        if(strlen($request->all()['password']) == 0){
            $validation = $this->validator($request->all(), ['required', 'email:dns', 'max:255', 'exists:employes'], []);
        }else {
            $validation = $this->validator($request->all(), ['required', 'email:dns', 'max:255', 'exists:employes'],['required','string', 'confirmed','min:8', 'max:10']);
        }

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $this->updatePersonnel($request->all(), $personnel_id);
        return redirect()->route('admins.comptes_personnels');
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
            'admin' => 0,
            'personnel' => 1,
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

    public function supprimerPersonnel($personnel_id){
        $personnel = Employe::find($personnel_id);
        $personnel->fiche_personnelle()->delete();
        $personnel->articles()->delete();

        $personnel->delete();

        return redirect()->route('admins.comptes_personnels')->with('success', 'Compte personnel supprimé avec succés !');
    }

}
