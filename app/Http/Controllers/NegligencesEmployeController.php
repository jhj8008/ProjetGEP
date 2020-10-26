<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\NotificationController;
use App\Employe;

class NegligencesEmployeController extends Controller
{
    public function __construct(){
        $this->middleware('personnel');
    }

    public function getListeEnseignants(){
        $enseignants = \App\Employe::select("*")->where('enseignant', '=', '1')->get();

        return view('Auth\employe\personnel\gestion_negligences_enseignants', compact('enseignants'));
    }

    public function getListeNegligencesEnseignant($enseignant_id){
        $enseignant = \App\Employe::find($enseignant_id);
        $negligences = $enseignant->negligenceemployes;
        return view('Auth\employe\personnel\liste_negligences', compact(['enseignant_id', 'negligences']));
    }

    public function pageFormAjouterNegligence($enseignant_id){
        return view('Auth\employe\personnel\form_ajouter_negligence', compact('enseignant_id'));
    }

    public function ajouterNegligence(Request $request, $enseignant_id){
        $validation = $this->validator($request->all());
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $neg = $this->createNegligence($request->all(), $enseignant_id);

        $enseignant = Employe::find($enseignant_id);

        $notif_cont = new NotificationController();
        $notifData = [
            'name' => 'GEP',
            'body' => 'Un(e) ' . $neg->type . ' vous [' . $enseignant->nom . ' ' . $enseignant->prénom . '] a été noté le: ' . $neg->date,
            'thanks' => 'Cordialement',
            'notifText' => 'Accèder à l\'espace des employés',
            'notifUrl' => url('/espace_employe'),
            'notif_id' => 007
        ];

        $notif_cont->sendEmployeNotification($notifData, $enseignant_id);

        return redirect()->route('personnels.liste_negligences', ['id' => $enseignant_id]);
    }

    public function pageFormModifierNegligence($enseignant_id, $negligence_id){
        $negligence = \App\NegligenceEmploye::find($negligence_id);
        return view('Auth\employe\personnel\form_modifier_negligence', compact(['enseignant_id', 'negligence']));
    }

    public function modifierNegligence(Request $request, $enseignant_id, $negligence_id){
        $validation = $this->validator($request->all());
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $this->updateNegligence($request->all(), $negligence_id);

        return redirect()->route('personnels.liste_negligences', ['id' => $enseignant_id]);
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'date' => ['required', 'string', 'max:255'],
            'durée' => ['required', 'string'],
            'période' => ['required', 'string', 'max:10'],
            'raison' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:10'],
        ]);
    }

    protected function createNegligence(array $data, $enseignant_id){
        return \App\NegligenceEmploye::create([
            'date' => date('Y-m-d',strtotime($data['date'])),
            'durée' => date('H:i',strtotime($data['durée'])),
            'période' => $data['période'],
            'raison' => $data['raison'],
            'type' => $data['type'],
            'employe_id' => $enseignant_id,
        ]);
    }

    protected function updateNegligence(array $data, $negligence_id){
        $negligence = \App\NegligenceEmploye::find($negligence_id);
        $negligence->date = date('Y-m-d',strtotime($data['date']));
        $negligence->durée = $data['durée'];
        $negligence->période = $data['période'];
        $negligence->raison = $data['raison'];
        $negligence->type = $data['type'];

        $negligence->save();
    }

    protected function supprimerNegligence($enseignant_id, $negligence_id){
        $negligence = \App\NegligenceEmploye::find($negligence_id);
        $negligence->delete();

        return redirect()->route('personnels.liste_negligences', ['id' => $enseignant_id]);
    }
}
