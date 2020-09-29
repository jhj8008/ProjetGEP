<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Negligence;

class AbsencesRetardsElèveController extends Controller
{
    public function __construct(){
        $this->middleware('enseignant');
    }

    public function index(){
        $enseignant = \App\Employe::find(Auth::guard('employe')->user()->id);
        $classes = $enseignant->classes;
        return view('Auth\employe\enseignant\absences_retards', compact('classes'));
    }

    public function getList($classe_id){
        $classe = \App\Classe::find($classe_id);
        $élèves = $classe->elèves;
        return view('Auth\employe\enseignant\liste_absence', compact(['élèves', 'classe_id']));
    }

    public function getProfile($classe_id,$élève_id){
        $élève = \App\Elève::find($élève_id);
        /*echo '<h2>Nom: ' . $élève_id . '</h2>';
        echo "<h2>Classe: " . $classe_id . "</h2>";*/
        return view('Auth\employe\enseignant\profile_absence', compact(['élève', 'classe_id', 'élève_id']));
    }

    public function ouvrirNegligence($classe_id, $élève_id, $negligence_id){
        $negligence = \App\Negligence::find($negligence_id);
        return view('Auth\employe\enseignant\modifier_negligence', compact(['classe_id','élève_id','negligence']));
    }

    public function modifierNegligence(Request $request, $classe_id, $élève_id, $negligence_id){
        $validation = $this->validator($request->all());
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }
        //$elève_id = $this->modifierAbsenceRetard($request->all());
        $this->modifierAbsenceRetard($request->all());

        return redirect()->route('enseignants.profile_absence', ['classe_id' => $classe_id,'élève_id' => $élève_id, 'id' => $negligence_id]);
    }

    public function supprimerNegligence($classe_id, $élève_id, $negligence_id){
        $negligence = \App\Negligence::find($negligence_id);
        $negligence->delete();
        return redirect()->back()->with('success', 'Négligence supprimée avec succès');
    }

    public function PageAjouterNegligence($classe_id,$élève_id){
        return view('Auth\employe\enseignant\ajouter_negligence', compact(['classe_id','élève_id']));
    }

    public function ajouterNegligence(Request $request, $classe_id, $élève_id){
        $validation = $this->validator($request->all());
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $neg = $this->createNegligence($request->all());
        /*$elève_id = $request->all()['elève_id'];*/
        return redirect()->route('enseignants.profile_absence', ['classe_id' => $classe_id,'élève_id' => $élève_id, 'id' => $neg->id]);
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'type' => ['required', 'string', 'max:20'],
            'date' => ['required', 'string', 'max:20'],
            'durée' => ['required','string'],
            'période' => ['required', 'string', 'max:10'],
            'séance' => ['required', 'string', 'max:30'],
            'raison' => ['required', 'string', 'max:10'],
        ]);
    }

    protected function createNegligence(array $data){
        $matière = \App\Matière::select("*")->where('nom', 'like', $data['séance'])->get();
        return Negligence::create([
            'type' => $data['type'],
            'date' => date('Y-m-d',strtotime($data['date'])),
            'durée' => $data['durée'],
            'période' => $data['période'],
            'raison' => $data['raison'],
            'employe_id' => Auth::guard('employe')->user()->id,
            'elève_id' => $data['elève_id'],
            'matière_id' => $matière[0]->id,
        ]);
    }

    protected function modifierAbsenceRetard(array $data){
        $negligence = Negligence::find(intval($data['negligence_id']));
        $negligence->type = $data['type'];
        $negligence->date = date('Y-m-d',strtotime($data['date']));
        $negligence->durée = $data['durée'];
        $negligence->période = $data['période'];
        $negligence->raison = $data['raison'];

        $élève = \App\Elève::find($negligence->elève_id);
        $matière = \App\Matière::select("*")->where('nom', 'like', $data['séance'])->get();

        $negligence->matière_id = $matière[0]->id;

        $negligence->save();
        /*return $negligence->elève_id;*/
    }
}

