<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use \App\Elève;
use \App\Elèveparent;
use PDF;

class GestionInfoElèveController extends Controller
{
    public function __construct(){
        $this->middleware('personnel');
    }

    public function index(){
        $élèves = \App\Elève::all();
        return view('Auth\employe\personnel\gestion_élèves', compact('élèves'));
    }

    public function getListeClasses(){
        $classes = \App\Classe::all();
        return view('Auth\employe\personnel\liste_classes', compact('classes'));
    }

    public function getListeParents(){
        $parents = Elèveparent::all();
        return view('Auth\employe\personnel\liste_parents', compact('parents'));
    }

    public function getProfileParent($parent_id){
        $parent = Elèveparent::find($parent_id);
        return view('Auth\employe\personnel\profile_parent', compact('parent'));
    }

    public function pageFormAjouterElève($parent_id){
        return view('Auth\employe\personnel\form_ajouter_élève', compact('parent_id'));
    }

    public function ajouterElève(Request $request, $parent_id){
        $valid = $this->validatorElève($request->all());
        if($valid->fails()){
            /*return redirect()->back()->withErrors($valid)->withInput();*/
            return response()->json(['errors' => $valid->errors()]);
        }

        $e = $this->createElève($request->all(), $parent_id);
        /*return redirect()->route('personnels.profile_parent', ['id' => $parent_id]);*/
        return response()->json(['success' => 'Nouveau élève ajouté avec succès', 'id' => $e->id, 'nom' => $e->nom, 'prénom' => $e->prénom, 'sexe' => $e->sexe, 'niveau_scolaire' => $e->niveau_scolaire]);
    }

    public function createElève(array $data, $parent_id) {
        return Elève::create([
            'nom' => $data['nom'],
            'prénom' => $data['prénom'], 
            'sexe' => $data['sexe'],
            'date_de_naissance' => date('Y-m-d',strtotime($data['date_de_naissance'])),
            'niveau_scolaire' => $data['niveau_scolaire'],
            'parent_id' => $parent_id,
            'classe_id' => 0,
        ]);
    }

    public function validatorElève(array $data){
        $messages = [
            'required' => ':attribute est obligatoire',
            'string' => ':attribute doit être une chaîne de caractères',
            'max' => 'la taille max de :attribute ne doit pas dépasser :max caractères',
            'min' => ':attribute doit être une chaîne de caractères',
        ];
        return Validator::make($data, [
            'nom' => ['required', 'string', 'max:255', 'min:3'],
            'prénom' => ['required', 'string', 'max:255', 'min:1'],
            'sexe' => ['required', 'string', 'max:255'],
            'date_de_naissance' => ['required'],
            'niveau_scolaire' => ['required', 'string', 'max:255', 'min:3'],
        ], $messages);
    }

    public function getListeClasse(Request $request, $classe_id){
        $classe = \App\Classe::find($classe_id);
        $élèves = $classe->elèves;
        $classe_nom = $classe->nom_classe;

        $pdf = PDF::loadView('Auth\employe\personnel\classe_élèves', compact(['élèves', 'classe_nom']));
        $pdf->save(storage_path().'_liste_élèves_' . $classe_id . '.pdf');
        return $pdf->download('_liste_élèves_' . $classe_id . '.pdf');
        /*return view('Auth\employe\personnel\classe_élèves', compact(['élèves', 'classe_nom']));*/
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
        ], $messages);
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
