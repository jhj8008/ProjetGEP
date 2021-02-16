<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Classe;
use \App\Matière;

class GestionClassesMatièresController extends Controller
{
    public function __construct(){
        $this->middleware('personnel');
    }

    public function index(){
        return view('Auth\employe\personnel\classes_matières');
    }

    public function pageGestionClasses(){
        $classes = \App\Classe::all();

        return view('Auth\employe\personnel\gestion_classes', compact('classes'));
    }

    public function pageModifierClasse($classe_id){
        $classe = Classe::find($classe_id);
        return view('Auth\employe\personnel\form_modifier_classe', compact('classe'));
    }

    public function pageAjouterClasse(){
        return view('Auth\employe\personnel\form_ajouter_classe');
    }

    public function supprimerClasse($classe_id){
        $classe = Classe::find($classe_id);
        $classe->delete();
        return redirect()->back()->with('success', 'Classe supprimée avec succés');
    }

    public function pageGestionMatières(){
        $matières = Matière::all();

        return view('Auth\employe\personnel\gestion_matières', compact('matières'));
    }

    public function supprimerMatière($matière_id){
        $matière = Matière::find($matière_id);

        $matière->delete();
        return redirect()->back()->with('success', 'Matière supprimée avec succés');
    }

    public function pageAjouterMatière(){
        return view('Auth\employe\personnel\form_ajouter_matière');
    }

    public function pageModifierMatière($matière_id){
        $matière = Matière::find($matière_id);
        return view('Auth\employe\personnel\form_modifier_matière', compact('matière'));
    }

    public function ajouterMatière(Request $request){
        $validation = $this->validatorMatière($request->all(), [
            'nom' => ['required', 'string', 'unique:matières'],
            'description' => ['required', 'string', 'max:255'],
            'coefficient' => ['required', 'integer'],
            'nbr_heures' => ['required', 'integer'],
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $this->createMatière($request->all());
        return redirect()->route('personnels.gestion_matières');
    }

    public function modifierMatière(Request $request, $matière_id){
        $matière = Matière::find($matière_id);
        $valid_array = [];
        if($matière->nom == $request->all()['nom']){
            $valid_array = [
                'description' => ['required', 'string', 'max:255'],
                'coefficient' => ['required', 'integer'],
                'nbr_heures' => ['required', 'integer'],
            ];
        }else {
            $valid_array = [
                'nom' => ['required', 'string', 'unique:matières'],
                'description' => ['required', 'string', 'max:255'],
                'coefficient' => ['required', 'integer'],
                'nbr_heures' => ['required', 'integer'],
            ];
        }
        $validation = $this->validatorMatière($request->all(), $valid_array);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $this->updateMatière($request->all(), $matière_id);
        return redirect()->route('personnels.gestion_matières');
    }

    public function validatorMatière(array $data, $rules){
        $messages = [
            'required' => ':attribute est obligatoire dans ce formulaire',
            'string' => ':attribute doit être une chaîne de caractères',
            'max' => 'la taille max de :attribute ne doit pas dépasser :max caractères',
            'integer' => ':attribute doit être un nombre entier',
            'unique' => ':attribute existe déjà, veuillez saisir un nouveau'
        ];
        return Validator::make($data, $rules, $messages);
    }

    public function updateMatière(array $data, $matière_id){
        $matière = Matière::find($matière_id);

        $matière->nom = $data['nom'];
        $matière->description = $data['description'];
        $matière->coefficient = $data['coefficient'];
        $matière->nbr_heures = $data['nbr_heures'];

        $matière->save();
    }

    public function createMatière(array $data){
        return Matière::create([
            'nom' => $data['nom'],
            'description' => $data['description'],
            'coefficient' => $data['coefficient'],
            'nbr_heures' => $data['nbr_heures'],
        ]);
    }

    public function ajouterClasse(Request $request){
        $validation = $this->validatorClasse($request->all(), [
            'nom_classe' => ['required', 'string', 'unique:classes'],
            'limite' => ['required', 'string', 'digits:2'],
        ]);
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $this->createClasse($request->all());
        return redirect()->route('personnels.gestion_classes');
    }

    protected function createClasse(array $data){
        $classe = Classe::create([
            'nom_classe' => $data['nom_classe'],
            'limite' => intval($data['limite']),
        ]);
        \App\Emploi_temp::create([
            'remarque' => 'Emploi du temps créé le ' . date('Y-m-d') . ' pour la classe ' . $classe->nom_classe,
            'année_scolaire' => date('Y') . "-" . date('Y', strtotime('+1 year')),
            'classe_id' => $classe->id,
        ]);
    }

    protected function validatorClasse(array $data, $rules){
        $messages = [
            'required' => ':attribute est obligatoire dans ce formulaire',
            'string' => ':attribute doit être une chaîne de caractères',
            'max' => 'la taille max de :attribute ne doit pas dépasser :max caractères',
            'unique' => ':attribute existe déjà, veuillez saisir un nouveau',
            'digits' => ':attribute doit être nombre composé de :digits chiffres'
        ];
        return Validator::make($data, $rules, $messages);
    }

    public function modifierClasse(Request $request, $classe_id){
        $classe = Classe::find($classe_id);
        $valid_array = [];
        if($classe->nom_classe == $request->all()['nom_classe']){
            $valid_array = ['limite' => ['required', 'string', 'digits:2']];
            //return route('my_page');
        }else {
            $valid_array = [
                'nom_classe' => ['required', 'string', 'unique:classes'],
                'limite' => ['required', 'string', 'digits:2'],
            ];
        }
        $validation = $this->validatorClasse($request->all(), $valid_array);
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $this->updateClasse($request->all(), $classe_id);
        return redirect()->route('personnels.gestion_classes');
    }

    protected function updateClasse(array $data, $classe_id){
        $classe = Classe::find($classe_id);

        $classe->nom_classe = $data['nom_classe'];
        $classe->limite = intval($data['limite']);
        $classe->save();
    }
}
