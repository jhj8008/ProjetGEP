<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GestionEmploisDuTempsController extends Controller
{
    public function __construct(){
        $this->middleware('personnel');
    }

    public function index(){
        $emplois = \App\Emploi_temp::all();
        return view('Auth\employe\personnel\gestion_emplois_du_temps', compact('emplois'));
    }

    public function getEmploiDuTemp($emploi_id){
        $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'];
        return view('Auth\employe\personnel\jours_edt', compact(['emploi_id', 'jours']));
    }

    public function getSéanceJour($emploi_id, $jour){
        $edt = \App\Emploi_temp::find($emploi_id);
        $t_séances = $edt->séances;
        $séances = [];
        foreach($t_séances as $s){
            if($s->jour == $jour){
                array_push($séances, $s);
            }
        }

        return view('Auth\employe\personnel\liste_séances', compact(['emploi_id', 'jour', 'séances']));
    }

    public function pageAjouterSéance($emploi_id, $jour){
        $edt = \App\Emploi_temp::find($emploi_id);
        $classe = \App\Classe::find($edt->classe_id);
        $employes = $classe->employes;
        return view('Auth\employe\personnel\form_ajouter_séance', compact(['emploi_id', 'jour', 'employes']));
    }

    public function pageModifierSéance($emploi_id, $jour, $séance_id){
        $edt = \App\Emploi_temp::find($emploi_id);
        $classe = \App\Classe::find($edt->classe_id);
        $employes = $classe->employes;
        $séance = \App\Séance::find($séance_id);
        return view('Auth\employe\personnel\form_modifier_séance', compact(['emploi_id', 'jour', 'séance', 'employes']));
    }

    public function supprimerSéance($emploi_id, $jour, $séance_id){
        $séance = \App\Séance::find($séance_id);
        $edt = \App\Emploi_temp::find($emploi_id);
        $edt->séances()->detach($séance_id);
        $séance->delete();
        return redirect()->back()->with('success', 'Séance supprimée avec succés');
    }

    public function ajouterSéance(Request $request){
        $validation = $this->validator($request->all());

        $emploi_id = $request->all()['emploi_id'];
        $jour = $request->all()['old_jour'];

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $this->createSéance($request->all(), $emploi_id);

        return redirect()->route('personnels.séances_jour', ['id' => $emploi_id, 'jour' => $jour]);
    }

    public function modifierSéance(Request $request, $emploi_id, $jour, $séance_id){
        $validation = $this->validator($request->all());

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $this->updateSéance($request->all(), $séance_id);

        return redirect()->route('personnels.séances_jour', ['id' => $emploi_id, 'jour' => $jour]);
    }

    public function getMatières(Request $request){
        $emp = \App\Employe::find($request->all()['employe_id']);
        //$matières = $emp->matières;

        return json_encode($emp->matières);
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'jour' => ['required', 'string'],
            'heure_début' => ['required', 'string'],
            'heure_fin' => ['required', 'string', 'after:heure_début'],
            'description' => ['string', 'max:255'],
            'employe_id' => ['required','integer'],
            'matière_id' => ['required', 'integer'],
        ]);
    }

    protected function createSéance(array $data, $emploi_id){
        $s = \App\Séance::create([
            'jour' => $data['jour'],
            'heure_début' => $data['heure_début'],
            'heure_fin' => $data['heure_fin'],
            'description' => $data['description'],
            'employe_id' => $data['employe_id'],
            'matière_id' => $data['matière_id'],
        ]);
        $edt = \App\Emploi_temp::find($emploi_id);
        $edt->séances()->attach($s->id);
    }

    protected function updateSéance(array $data, $séance_id){
        $séance = \App\Séance::find($séance_id);
        $séance->jour = $data['jour'];
        $séance->heure_début = $data['heure_début'];
        $séance->heure_fin = $data['heure_fin'];
        $séance->description = $data['description'];
        $séance->employe_id = $data['employe_id'];
        $séance->matière_id = $data['matière_id'];

        $séance->save();
    }
}
