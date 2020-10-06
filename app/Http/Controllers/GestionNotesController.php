<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GestionNotesController extends Controller
{
    public function __construct(){
        $this->middleware('enseignant');
    }

    public function index(){
        return view('Auth\employe\enseignant\notes');
    }

    public function getListeNotesELève($matière_id){
        $notes = \App\Note::select("*")->where('matière_id','=', $matière_id)->get();
        return view('Auth\employe\enseignant\liste_notes_élève', compact('notes'));
    }

    public function getPageNote($matière_id, $note_id){
        $note = \App\Note::find($note_id);
        return view('Auth\employe\enseignant\page_note_élève', compact('note'));
    }

    public function modifierNote(Request $request, $matière_id, $note_id){
        $validation = $this->validator($request->all());
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $this->updateNote($request->all(), $note_id);
        return redirect()->route('enseignants.liste_notes_élève', ['id' => $matière_id]);
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'valeur' => ['required', 'string', 'regex:/^-?(?:\d+|\d*\.\d+)$/', 'max:7'],
            'valeur2' => ['required', 'string', 'regex:/^-?(?:\d+|\d*\.\d+)$/', 'max:7'],
            'remarque' => ['required','string', 'max:255'],
        ]);
    }

    protected function updateNote(array $data, $note_id){
        $note = \App\Note::find($note_id);
        $note->valeur = $data['valeur'];
        $note->remarque = $data['remarque'];
        $note->valeur2 = $data['valeur2'];

        $note->save();
    }

    
}
