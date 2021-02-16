<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Candidate;
use App\Events\IncrementVotes;

class VoteController extends Controller
{

    public function index(){
        $polls = \App\Poll::whereHas('employes', function($q){
            $q->whereNotNull('employe_id');
        })->get();
        return view('Auth\employe\liste_sondages', compact('polls'));
    }
    public function incrementVotes(Candidate $candidate){
        $candidate->increment('votes_count');
        return $this->candidates($candidate->poll_id);
    }

    public function candidates($poll_id){
        $poll = \App\Poll::find($poll_id);
        $candidates = $poll->candidates;
        return response()->json([
            'data' => $poll->candidates
        ]);
    }

    public function pageFormAjouterSondage(){
        return view('Auth\employe\form_ajouter_sondage');
    }

    public function ajouterSondage(Request $request){
        //$x = $request->all()['nbr_choix'];
        $poll = $this->createSondage($request->all());   

        // attach poll to its creator
        $emp = \App\Employe::find(Auth::guard('employe')->user()->id);
        $emp->polls()->attach($poll->id);

        for($i = 1 ; $i<=$request->all()['nbr_choix'] ; $i++){
            $c = $request->all()['choix' . $i];
            /*echo '<h1>Choix n° ' . $i . ': ' . $c . '</h1>';*/
            Candidate::create([
                'desc' => $c,
                'poll_id' => $poll->id,
            ]);
        }

        return redirect()->route('employés.liste_sondages');
    }

    public function createSondage(array $data){
        return \App\Poll::create([
            'desc' => $data['desc'],
            'deadline' => date("Y-m-d H:i:s", strtotime($data['date'] . ' ' . $data['heure'] . ':00')),
        ]);
    }
}
