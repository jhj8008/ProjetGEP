<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class GestionEnseignantsController extends Controller
{
    public function __construct(){
        $this->middleware('personnel');
    }

    public function index(){
        return view('Auth\employe\personnel\gestion_enseignants');
    }

    public function getEnseignants(){
        $enseignants = \App\Employe::select("*")->where('enseignant', '=', '1')->get();
        return view('Auth\employe\personnel\liste_enseignants', compact('enseignants'));
    }

    public function pageFormAjouterEnseignant(){
        return view('Auth\employe\personnel\form_créer_enseignant');
    }
    
    public function pageFormModifierEnseignant($enseignant_id) {
        $enseignant = \App\Employe::find($enseignant_id);
        return view('Auth\employe\personnel\form_modifier_enseignant', compact(['enseignant_id', 'enseignant']));
    }

    public function pageAffectationClasses(){
        $enseignants = \App\Employe::select("*")->where('enseignant', '=', '1')->get();
        return view('Auth\employe\personnel\page_affectation_classes', compact('enseignants'));
    }

    public function getListeClasses($enseignant_id){
        $enseignant = \App\Employe::find($enseignant_id);
        $classes = $enseignant->classes;
        $classes_non_existantes = \App\Classe::whereDoesntHave('employes', function($q) use ($enseignant_id){
            $q->where('employe_id', $enseignant_id);
        })->get();
        return view('Auth\employe\personnel\liste_classes_affecter', compact(['classes', 'enseignant_id', 'classes_non_existantes']));
    }

    public function ajouterClasseEnseignant(Request $request, $enseignant_id){
        $classe_id = $request->all()['classe'];
        $enseignant = \App\Employe::find($enseignant_id);
        $enseignant->classes()->attach($classe_id);

        return redirect()->route('personnels.liste_classes_affecter', ['id' => $enseignant_id]);
    }

    public function supprimerClasse($enseignant_id, $classe_id){
        $enseignant = \App\Employe::find($enseignant_id);
        $enseignant->classes()->detach($classe_id);

        return redirect()->back()->with('success', 'Classe supprimée avec succés');
    }

    public function pageAffectationMatières(){
        $enseignants = \App\Employe::select("*")->where('enseignant', '=', '1')->get();
        return view('Auth\employe\personnel\page_affectation_matières', compact('enseignants'));
    }

    public function getListeMatières($enseignant_id){
        $enseignant = \App\Employe::find($enseignant_id);
        $matières = $enseignant->matières;
        $matières_non_existantes = \App\Matière::whereDoesntHave('employes', function($q) use ($enseignant_id){
            $q->where('employe_id', $enseignant_id);
        })->get();

        return view('Auth\employe\personnel\liste_matières_affecter', compact(['matières', 'enseignant_id', 'matières_non_existantes']));
    }

    public function ajouterMatièreEnseignant(Request $request, $enseignant_id){
        $matière_id = $request->all()['matière'];
        $enseignant = \App\Employe::find($enseignant_id);
        $enseignant->matières()->attach($matière_id);

        return redirect()->route('personnels.liste_matières_affecter', ['id' => $enseignant_id]);
    }
    
    public function supprimerMatière($enseignant_id, $matière_id){
        $enseignant = \App\Employe::find($enseignant_id);
        $enseignant->matières()->detach($matière_id);

        return redirect()->back()->with('success', 'Matière supprimée avec succés');
    }

    public function modifierEnseignant(Request $request, $enseignant_id){

        //$email_exits = ['required', 'email:dns', Rule::unique('employes', 'email')->ignore($user->id)];
        if(strlen($request->all()['password']) == 0){
            $validation = $this->updateValidator($request->all(), ['string', 'max:255'], $enseignant_id);
        }else {
            $validation = $this->updateValidator($request->all(), ['required','string', 'confirmed','min:8', 'max:10'], $enseignant_id);
        }

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $this->updateEnseignant($request->all(), $enseignant_id);
        return redirect()->route('personnels.comptes_enseignants');
    }

    public function créerEnseignant(Request $request){
        $validation = $this->validator($request->all(), ['required', 'string', 'confirmed','min:8', 'max:10'], ['required', 'email:dns', 'max:255', 'unique:employes']); 

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $this->createEnseignant($request->all());

        return redirect()->route('personnels.comptes_enseignants');
    }

    protected function updateValidator(array $data, $rule, $enseignant_id){
        $messages = [
            'required' => ':attribute est obligatoire dans ce formulaire',
            'string' => ':attribute doit être une chaîne de caractères',
            'max' => 'la taille max de :attribute ne doit pas dépasser :max caractère(s)',
            'email' => 'veuillez corriger votre email. Ex: xyz@abc.fr',
            'min' => 'la taille min de :attribute doit avoir au moins :min caractère(s)',
            'confirmed' => 'veuillez confirmer votre mot de passe',
            'unique' => 'cet :attribute existe déjà, veuillez réessayer avec un autre',
            'digits' => 'cet :attribute doit être un nombre composé de :digits chiffre(s)',
            'exists' => 'cet :attribute est inexistant'
        ];
        return Validator::make($data, [
            'nom' => ['required', 'string', 'max:255'],
            'prénom' => ['required', 'string', 'max:255'],
            'sexe' => ['required', 'string', 'max:2', 'min:1'], 
            'date_de_naissance' => ['required', 'string', 'max:255'], 
            'fonction' => ['required', 'string', 'max:255', 'min:4'], 
            'email' => ['required', 'email:dns', 'max:255', 'exists:employes'], 
            'password' => $rule, 
            'adresse' => ['required', 'string', 'max:255'], 
            'tel' => ['required', 'string', 'digits:10'],
        ], $messages);
    }

    protected function validator(array $data, $rule, $email_rule){
        $messages = [
            'required' => ':attribute est obligatoire dans ce formulaire',
            'string' => ':attribute doit être une chaîne de caractères',
            'max' => 'la taille max de :attribute ne doit pas dépasser :max caractère(s)',
            'email' => 'veuillez corriger votre email. Ex: xyz@abc.fr',
            'min' => 'la taille min de :attribute doit avoir au moins :min caractère(s)',
            'confirmed' => 'veuillez confirmer votre mot de passe',
            'unique' => 'cet :attribute existe déjà, veuillez réessayer avec un autre',
            'digits' => 'cet :attribute doit être un nombre composé de :digits chiffre(s)',
            'exists' => 'cet :attribute est inexistant'
        ];
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
        ], $messages);
    }

    protected function createEnseignant(array $data){
        $emp = \App\Employe::create([
            'nom' => $data['nom'], 
            'prénom' => $data['prénom'], 
            'sexe' => $data['sexe'], 
            'date_de_naissance' => date('Y-m-d',strtotime($data['date_de_naissance'])), 
            'fonction' => $data['fonction'], 
            'email' => $data['email'], 
            'password' => Hash::make($data['password']),
            'adresse' => $data['adresse'], 
            'tel' => $data['tel'],
            'admin' => 0,
            'personnel' => 0,
            'enseignant' => 1,
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
            'employe_id' => $emp->id,
        ]);
    }

    protected function updateEnseignant(array $data, $enseignant_id){
        $enseignant = \App\Employe::find($enseignant_id);

        $enseignant->nom = $data['nom'];
        $enseignant->prénom = $data['prénom'];
        $enseignant->sexe = $data['sexe'];
        $enseignant->date_de_naissance = date('Y-m-d',strtotime($data['date_de_naissance']));
        $enseignant->fonction = $data['fonction'];
        $enseignant->email = $data['email'];

        if(strlen($data['password']) > 0){
            $enseignant->password = Hash::make($data['password']);    
        }

        $enseignant->adresse = $data['adresse'];
        $enseignant->tel = $data['tel'];

        $enseignant->save();
    }

    public function supprimerEnseignant($enseignant_id){
        $enseignant = \App\Employe::find($enseignant_id);
        $enseignant->negligences()->delete();
        $enseignant->séances()->delete();
        $enseignant->cahier_textes()->delete();
        $enseignant->fiche_personnelle()->delete();
        $enseignant->articles()->delete();
        $matières = $enseignant->matières;
        $classes = $enseignant->classes;
        foreach($matières as $matière){
            $enseignant->matières()->detach($matière->id);
        }

        foreach($classes as $classe){
            $enseignant->classes()->detach($classe->id);
        }

        $enseignant->delete();

        return redirect()->route('personnels.comptes_enseignants');
    }

    public function gestionAbsencesRetards(){
        // code
    }
}
